<?php

namespace App\Enums;

enum CryptcpErrorCodes: int
{
    case MEMORY_ERROR = 536871012;
    case FILE_OPEN_ERROR = 536871013;
    case OPERATION_CANCELLED = 536871014;
    case BASE64_CONVERSION_ERROR = 536871015;
    case HELP_PARAMETER_ERROR = 536871016;
    case FILE_TOO_LARGE = 536871017;
    case INTERNAL_ERROR = 536871024;
    case EXTRA_FILE_SPECIFIED = 536871112;
    case UNKNOWN_KEY = 536871113;
    case EXTRA_COMMAND = 536871114;
    case KEY_PARAMETER_MISSING = 536871115;
    case COMMAND_NOT_SPECIFIED = 536871116;
    case REQUIRED_KEY_MISSING = 536871117;
    case INVALID_KEY = 536871118;
    case INVALID_Q_PARAMETER = 536871119;
    case INPUT_FILE_NOT_SPECIFIED = 536871120;
    case OUTPUT_FILE_NOT_SPECIFIED = 536871121;
    case COMMAND_NO_FILENAME_PARAMETER = 536871122;
    case MESSAGE_FILE_NOT_SPECIFIED = 536871123;
    case CERTIFICATE_STORE_OPEN_ERROR = 536871212;
    case CERTIFICATES_NOT_FOUND = 536871213;
    case MULTIPLE_CERTIFICATES_FOUND = 536871214;
    case SINGLE_CERTIFICATE_REQUIRED = 536871215;
    case INVALID_NUMBER = 536871216;
    case NO_USABLE_CERTIFICATES = 536871217;
    case CERTIFICATE_NOT_APPLICABLE = 536871218;
    case CERTIFICATE_CHAIN_NOT_VERIFIED = 536871219;
    case CRYPTOPROVIDER_NOT_FOUND = 536871220;
    case CONTAINER_PASSWORD_ERROR = 536871221;
    case PRIVATE_KEY_ERROR = 536871222;
    case FILE_MASK_NOT_SPECIFIED = 536871312;
    case MULTIPLE_FILE_MASKS = 536871313;
    case FILES_NOT_FOUND = 536871314;
    case INVALID_MASK = 536871315;
    case INVALID_HASH = 536871316;
    case START_KEY_NO_OUTPUT = 536871412;
    case NOT_SIGNED_MESSAGE = 536871413;
    case UNKNOWN_SIGNATURE_ALGORITHM = 536871414;
    case SIGNATURE_AUTHOR_CERTIFICATE_NOT_FOUND = 536871415;
    case SIGNATURE_NOT_FOUND = 536871416;
    case INVALID_SIGNATURE = 536871417;
    case INVALID_TIMESTAMP = 536871418;
    case NOT_ENCRYPTED_MESSAGE = 536871512;
    case UNKNOWN_ENCRYPTION_ALGORITHM = 536871513;
    case CERTIFICATE_WITH_SECRET_KEY_NOT_FOUND = 536871514;
    case COM_INITIALIZATION_ERROR = 536871612;
    case CONTAINERS_NOT_FOUND = 536871613;
    case SERVER_RESPONSE_ERROR = 536871614;
    case CERTIFICATE_NOT_IN_SERVER_RESPONSE = 536871615;
    case FILE_NO_REQUEST_ID = 536871616;
    case INVALID_CA_ADDRESS = 536871617;
    case INVALID_COOKIE = 536871618;
    case CA_REQUEST_REJECTED = 536871619;
    case CURL_INITIALIZATION_ERROR = 536871620;
    case SERIAL_NUMBER_INVALID_LENGTH = 536871712;
    case INVALID_PRODUCT_CODE = 536871713;
    case SERIAL_NUMBER_VERIFICATION_ERROR = 536871714;
    case SERIAL_NUMBER_SAVE_ERROR = 536871715;
    case SERIAL_NUMBER_LOAD_ERROR = 536871716;
    case LICENSE_EXPIRED = 536871717;

    /**
     * Получить текстовое описание ошибки
     */
    public function getMessage(): string
    {
        return match($this) {
            self::MEMORY_ERROR => 'Мало памяти',
            self::FILE_OPEN_ERROR => 'Не удалось открыть файл',
            self::OPERATION_CANCELLED => 'Операция отменена пользователем',
            self::BASE64_CONVERSION_ERROR => 'Некорректное преобразование BASE64',
            self::HELP_PARAMETER_ERROR => 'Если указан параметр \'-help\', то других быть не должно',
            self::FILE_TOO_LARGE => 'Файл слишком большой',
            self::INTERNAL_ERROR => 'Произошла внутренняя ошибка',
            self::EXTRA_FILE_SPECIFIED => 'Указан лишний файл',
            self::UNKNOWN_KEY => 'Указан неизвестный ключ',
            self::EXTRA_COMMAND => 'Указана лишняя команда',
            self::KEY_PARAMETER_MISSING => 'Для ключа не указан параметр',
            self::COMMAND_NOT_SPECIFIED => 'Не указана команда',
            self::REQUIRED_KEY_MISSING => 'Не указан необходимый ключ',
            self::INVALID_KEY => 'Указан неверный ключ',
            self::INVALID_Q_PARAMETER => 'Параметром ключа \'-q\' должно быть натуральное число',
            self::INPUT_FILE_NOT_SPECIFIED => 'Не указан входной файл',
            self::OUTPUT_FILE_NOT_SPECIFIED => 'Не указан выходной файл',
            self::COMMAND_NO_FILENAME_PARAMETER => 'Команда не использует параметр с именем файла',
            self::MESSAGE_FILE_NOT_SPECIFIED => 'Не указан файл сообщения',
            self::CERTIFICATE_STORE_OPEN_ERROR => 'Не удалось открыть хранилище сертификатов',
            self::CERTIFICATES_NOT_FOUND => 'Сертификаты не найдены',
            self::MULTIPLE_CERTIFICATES_FOUND => 'Найдено более одного сертификата (ключ \'-1\')',
            self::SINGLE_CERTIFICATE_REQUIRED => 'Команда подразумевает использование только одного сертификата',
            self::INVALID_NUMBER => 'Неверно указан номер',
            self::NO_USABLE_CERTIFICATES => 'Нет используемых сертификатов',
            self::CERTIFICATE_NOT_APPLICABLE => 'Данный сертификат не может применяться для этой операции',
            self::CERTIFICATE_CHAIN_NOT_VERIFIED => 'Цепочка сертификатов не проверена',
            self::CRYPTOPROVIDER_NOT_FOUND => 'Криптопровайдер, поддерживающий необходимый алгоритм не найден',
            self::CONTAINER_PASSWORD_ERROR => 'Ошибка при вводе пароля на контейнер',
            self::PRIVATE_KEY_ERROR => 'Не удалось получить закрытый ключ сертификата',
            self::FILE_MASK_NOT_SPECIFIED => 'Не указана маска файлов',
            self::MULTIPLE_FILE_MASKS => 'Указаны несколько масок файлов',
            self::FILES_NOT_FOUND => 'Файлы не найдены',
            self::INVALID_MASK => 'Задана неверная маска',
            self::INVALID_HASH => 'Неверный хэш',
            self::START_KEY_NO_OUTPUT => 'Ключ \'-start\' указан, а выходной файл нет',
            self::NOT_SIGNED_MESSAGE => 'Содержимое файла - не подписанное сообщение',
            self::UNKNOWN_SIGNATURE_ALGORITHM => 'Неизвестный алгоритм подписи',
            self::SIGNATURE_AUTHOR_CERTIFICATE_NOT_FOUND => 'Сертификат автора подписи не найден',
            self::SIGNATURE_NOT_FOUND => 'Подпись не найдена',
            self::INVALID_SIGNATURE => 'Подпись не верна',
            self::INVALID_TIMESTAMP => 'Штамп времени не верен',
            self::NOT_ENCRYPTED_MESSAGE => 'Содержимое файла - не зашифрованное сообщение',
            self::UNKNOWN_ENCRYPTION_ALGORITHM => 'Неизвестный алгоритм шифрования',
            self::CERTIFICATE_WITH_SECRET_KEY_NOT_FOUND => 'Не найден сертификат с соответствующим секретным ключом',
            self::COM_INITIALIZATION_ERROR => 'Не удалось инициализировать COM',
            self::CONTAINERS_NOT_FOUND => 'Контейнеры не найдены',
            self::SERVER_RESPONSE_ERROR => 'Не удалось получить ответ от сервера',
            self::CERTIFICATE_NOT_IN_SERVER_RESPONSE => 'Сертификат не найден в ответе сервера',
            self::FILE_NO_REQUEST_ID => 'Файл не содержит идентификатор запроса',
            self::INVALID_CA_ADDRESS => 'Некорректный адрес ЦС',
            self::INVALID_COOKIE => 'Получен неверный Cookie',
            self::CA_REQUEST_REJECTED => 'ЦС отклонил запрос',
            self::CURL_INITIALIZATION_ERROR => 'Ошибка при инициализации CURL',
            self::SERIAL_NUMBER_INVALID_LENGTH => 'Серийный номер содержит недопустимое количество символов',
            self::INVALID_PRODUCT_CODE => 'Неверный код продукта',
            self::SERIAL_NUMBER_VERIFICATION_ERROR => 'Не удалось проверить серийный номер',
            self::SERIAL_NUMBER_SAVE_ERROR => 'Не удалось сохранить серийный номер',
            self::SERIAL_NUMBER_LOAD_ERROR => 'Не удалось загрузить серийный номер',
            self::LICENSE_EXPIRED => 'Лицензия просрочена',
        };
    }

    /**
     * Получить категорию ошибки
     */
    public function getCategory(): string
    {
        return match($this) {
            self::MEMORY_ERROR, self::FILE_OPEN_ERROR, self::FILE_TOO_LARGE, self::INTERNAL_ERROR => 'Системные ошибки',
            self::OPERATION_CANCELLED => 'Пользовательские действия',
            self::BASE64_CONVERSION_ERROR, self::INVALID_HASH => 'Ошибки данных',
            self::HELP_PARAMETER_ERROR, self::EXTRA_FILE_SPECIFIED, self::UNKNOWN_KEY, self::EXTRA_COMMAND,
            self::KEY_PARAMETER_MISSING, self::COMMAND_NOT_SPECIFIED, self::REQUIRED_KEY_MISSING,
            self::INVALID_KEY, self::INVALID_Q_PARAMETER, self::INPUT_FILE_NOT_SPECIFIED,
            self::OUTPUT_FILE_NOT_SPECIFIED, self::COMMAND_NO_FILENAME_PARAMETER, self::MESSAGE_FILE_NOT_SPECIFIED => 'Ошибки параметров',
            self::CERTIFICATE_STORE_OPEN_ERROR, self::CERTIFICATES_NOT_FOUND, self::MULTIPLE_CERTIFICATES_FOUND,
            self::SINGLE_CERTIFICATE_REQUIRED, self::INVALID_NUMBER, self::NO_USABLE_CERTIFICATES,
            self::CERTIFICATE_NOT_APPLICABLE, self::CERTIFICATE_CHAIN_NOT_VERIFIED, self::CONTAINER_PASSWORD_ERROR,
            self::PRIVATE_KEY_ERROR => 'Ошибки сертификатов',
            self::CRYPTOPROVIDER_NOT_FOUND => 'Ошибки криптопровайдера',
            self::FILE_MASK_NOT_SPECIFIED, self::MULTIPLE_FILE_MASKS, self::FILES_NOT_FOUND, self::INVALID_MASK => 'Ошибки файлов',
            self::START_KEY_NO_OUTPUT, self::NOT_SIGNED_MESSAGE, self::UNKNOWN_SIGNATURE_ALGORITHM,
            self::SIGNATURE_AUTHOR_CERTIFICATE_NOT_FOUND, self::SIGNATURE_NOT_FOUND, self::INVALID_SIGNATURE,
            self::INVALID_TIMESTAMP => 'Ошибки подписи',
            self::NOT_ENCRYPTED_MESSAGE, self::UNKNOWN_ENCRYPTION_ALGORITHM, self::CERTIFICATE_WITH_SECRET_KEY_NOT_FOUND => 'Ошибки шифрования',
            self::COM_INITIALIZATION_ERROR, self::CONTAINERS_NOT_FOUND, self::SERVER_RESPONSE_ERROR,
            self::CERTIFICATE_NOT_IN_SERVER_RESPONSE, self::FILE_NO_REQUEST_ID, self::INVALID_CA_ADDRESS,
            self::INVALID_COOKIE, self::CA_REQUEST_REJECTED, self::CURL_INITIALIZATION_ERROR => 'Сетевые ошибки',
            self::SERIAL_NUMBER_INVALID_LENGTH, self::INVALID_PRODUCT_CODE, self::SERIAL_NUMBER_VERIFICATION_ERROR,
            self::SERIAL_NUMBER_SAVE_ERROR, self::SERIAL_NUMBER_LOAD_ERROR, self::LICENSE_EXPIRED => 'Ошибки лицензирования',
        };
    }

    /**
     * Проверить критичность ошибки
     */
    public function isCritical(): bool
    {
        return match($this) {
            self::MEMORY_ERROR, self::INTERNAL_ERROR, self::CRYPTOPROVIDER_NOT_FOUND,
            self::COM_INITIALIZATION_ERROR, self::CURL_INITIALIZATION_ERROR => true,
            default => false,
        };
    }

    /**
     * Получить форматированное сообщение об ошибке
     */
    public static function getErrorMessage(int $errorCode): string
    {
        $enum = self::tryFrom($errorCode);
        if ($enum) {
            return sprintf('[%d] %s', $errorCode, $enum->getMessage());
        }
        return sprintf('[%d] Неизвестная ошибка CryptCP', $errorCode);
    }

    /**
     * Получить детальную информацию об ошибке
     */
    public static function getErrorDetails(int $errorCode): array
    {
        $enum = self::tryFrom($errorCode);
        if ($enum) {
            return [
                'code' => $errorCode,
                'message' => $enum->getMessage(),
                'category' => $enum->getCategory(),
                'is_critical' => $enum->isCritical(),
                'formatted_message' => sprintf('[%d] %s', $errorCode, $enum->getMessage())
            ];
        }

        return [
            'code' => $errorCode,
            'message' => 'Неизвестная ошибка CryptCP',
            'category' => 'Неизвестная категория',
            'is_critical' => false,
            'formatted_message' => sprintf('[%d] Неизвестная ошибка CryptCP', $errorCode)
        ];
    }
}
