<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;

class EsiaServices {

    private string $state;
    private string $timestamp;
    private string $client_id;
    private string $redirect_uri;
    private array $scope;
    private string $response_type;
    private string $access_type;

    private string $esia_url;
    private string $esia_auth_url_sufix;
    private string $esia_token_url_sufix;

    private string $signer_token;
    private string $signer_url;

    private string $access_token;
    //OID Пользователя
    private ?int $oid = null;


    public function __get($name)
    {
        if ($name === 'oid') {
            return $this->oid;
        }

        if ($name === 'access_token') {
            return $this->access_token;
        }

        throw new \Exception("Property {$name} does not exist.");
    }

    public function __construct() {
        $this->client_id = config('esia.esia_mnimonica');
        $this->redirect_uri = config('esia.esia_redirect_url');
        $this->scope = config('esia.esia_scope');
        $this->response_type = config('esia.esia_response_type');
        $this->access_type = config('esia.esia_access_type');

        $this->esia_auth_url_sufix = config('esia.esia_auth_url_sufix');
        $this->esia_token_url_sufix = config('esia.esia_token_url_sufix');
        $this->esia_url = config('esia.esia_url');

        $this->signer_token = config('esia.signer_token');
        $this->signer_url = config('esia.signer_url');

        $this->state = $this->seedState();
        $this->timestamp = $this->makeTimestamp();
    }

    public function getAuthLink(): string
    {
        $queryParams = [
            'client_id' => $this->client_id,
            'client_secret' => $this->signer($this->makeSecret()),
            'redirect_uri' => $this->redirect_uri,
            'scope' => $this->getScopesString(),
            'response_type' => $this->response_type,
            'state' => $this->state,
            'timestamp' => $this->timestamp,
            'access_type' => $this->access_type,
        ];

        $link = $this->esia_url . $this->esia_auth_url_sufix ."?". http_build_query($queryParams);

        return $link;
    }

    protected function do_query($url) : object {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->access_token,
        ])->get($url)->body();

        return json_decode($response);
    }

    public function get_person() : object {
        if (empty($this->oid))
            return [];

        return $this->do_query($this->esia_url."/rs/prns/".$this->oid);
    }

    public function get_contact() : array {
        if (empty($this->oid))
            return [];

        $contact_lnk = $this->do_query($this->esia_url."/rs/prns/".$this->oid."/ctts");

        $result = [];
        foreach ($contact_lnk->elements as $elementUrl) {
            $elementPayload = $this->do_query($elementUrl);

            if ($elementPayload) {
                $result[$elementPayload->type] = $elementPayload->value;
            }
        }

        return $result;
    }

    public function getToken(string $code, string $state): void {
        $queryParams = [
            'client_id' => $this->client_id,
            'code' => $code,
            'grant_type' => 'authorization_code',
            'client_secret' => $this->signer($this->makeSecret($state)),
            'state' => $state,
            'redirect_uri' => $this->redirect_uri,
            'scope' => $this->getScopesString(),
            'response_type' => $this->response_type,
            'timestamp' => $this->timestamp,
            'token_type' => 'Bearer',
        ];

        $response = Http::asForm()->post($this->esia_url . $this->esia_token_url_sufix, $queryParams)->body();
        $response = json_decode($response);
        $payload = $this->jwtDecode($response->access_token);

        // dd($response, $payload);

        $this->oid = $payload["urn:esia:sbj_id"];
        $this->access_token = $response->access_token;
    }

    private function jwtDecode(string $token)
    {
        return json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $token)[1]))), true);
    }

    private function makeSecret(string $state=""): string
    {
        $state_sectet = (empty($state))?$this->state:$state;
        return $this->getScopesString() . $this->timestamp . $this->client_id . $state_sectet;
    }

    private function makeTimestamp(): string
    {
        return date('Y.m.d H:i:s O');
    }

    private function signer(string $pacedge): string
    {
        try {
            $http = [
                'method' => 'POST',
                'header' => [
                    'Authorization: Bearer ' . $this->signer_token,
                    'Content-Type: application/octet-stream',
                    'Accept: application/pkcs7-signature',
                ],
                'content' => $pacedge,
            ];
            // dd($this->signer_url, $this->signer_token, $pacedge);
            $signature = file_get_contents($this->signer_url, false, stream_context_create(['http' => $http]));

            return $this->url_safe_base64_encode($signature);
        } catch (\Throwable $e) {
            return "sory ".$e->getMessage();
        }

    }

    private function seedState(): string
    {
        try {
            return sprintf(
                '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                random_int(0, 0xffff),
                random_int(0, 0xffff),
                random_int(0, 0xffff),
                random_int(0, 0x0fff) | 0x4000,
                random_int(0, 0x3fff) | 0x8000,
                random_int(0, 0xffff),
                random_int(0, 0xffff),
                random_int(0, 0xffff)
            );
        } catch (Exception $e) {
            throw new Exception('Cannot generate random integer', $e);
        }
    }

    public function getScopesString(): string{
        return implode(' ', $this->scope);
    }

    private function url_safe_base64_encode($string)
    {
        $data = base64_encode($string);
        $no_of_eq = substr_count($data, "=");
        $data = str_replace("=", "", $data);
        $data = $data.$no_of_eq;
        $data = str_replace(array('+','/'),array('-','_'),$data);
        return $data;

    }
}
