<?php

namespace App\View\Components\Goskey;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SignDocument extends Component
{
    public bool $signActive;
    public bool $signProcess;
    public $document;
    public string $message = 'Проверяем Вашу учетную запись на возможность подписания документов по средствам мобильного приложения "Госключ" ...';

    /**
     * Create a new component instance.
     */
    public function __construct($document = null)
    {
        $this->document = $document;
        $this->signActive = false;
        $this->signProcess = false;
        if (auth()->user()->snils == null && auth()->user()->oid == null ) {
            $this->message = 'На данный момент подписание документа не возможно! Вам необходимо пройти регистрацию на нашем портале через Госуслуги или заполнить поле СНИЛС в <a href="'.route('user-data').'">параметрах вашего профиля.</a>';
        } elseif ($document == null) {
            $this->message = "Чтобы подписание было доступно заполните форму, сохраните черновик а после нажмите кнопку проверить.";
        } elseif($document->validated == false) {
            $this->message = "Перед подписанием черновик нужно проверить. Нажмите кнопку «Проверить» на панели.";
        } elseif($document->goskeyRegistries()->exists()) {
            $this->message = "Документ уже отправлен на подписание.";
            $this->signProcess = true;
            $this->signActive = true;
        } else {
            $this->message = "Выберите тип подписания документа:";
            $this->signActive = true;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.goskey.sign-document');
    }
}
