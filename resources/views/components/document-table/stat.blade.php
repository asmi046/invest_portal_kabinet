<div class="columns-box columns-box--two-col project-panel">
                <x-widget-green-stat
                    lnk="{{ $documentType->create_url }}"
                    lnktxt="Создать заявление"
                    status="Проекты"
                    :value="$state['Всего']"
                    title="Всего проектов"
                    icon="briefcase-icon"
                ></x-widget-green-stat>


                <div class="columns-box__right-col">
                    @isset($state['Черновик'])
                        <x-widget-stat
                            :value="$state['Черновик']"
                            title="проектов в статусе черновик"
                            icon="two-docs-icon"
                        ></x-widget-stat>
                    @endisset

                    @isset($state['Отправлено на рассмотрение'])
                        <x-widget-stat
                            :value="$state['Отправлено на рассмотрение']"
                            title="проектов в статусе отправлено на рассмотрение"
                            icon="two-docs-icon"
                        ></x-widget-stat>
                    @endisset

                    @isset($state['Принят'])
                        <x-widget-stat
                            :value="$state['Принят']"
                            title="проектов в статусе принят"
                            icon="two-docs-icon"
                        ></x-widget-stat>
                    @endisset
                </div>
</div>
