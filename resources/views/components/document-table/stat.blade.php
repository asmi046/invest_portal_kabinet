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

                    @isset($state['На рассмотрении'])
                        <x-widget-stat
                            :value="$state['На рассмотрении']"
                            title="проектов в статусе отправлено на рассмотрение"
                            icon="two-docs-icon"
                        ></x-widget-stat>
                    @endisset

                    @isset($state['Требуется доработка'])
                        <x-widget-stat
                            :value="$state['Требуется доработка']"
                            title="проектов в статусе принят"
                            icon="two-docs-icon"
                        ></x-widget-stat>
                    @endisset
                </div>
</div>
