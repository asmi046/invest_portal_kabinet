/* <div class="file-funnel">
    <input type="file" name="file" class="file-funnel__file-input" multiple="multiple">
    <div class="file-funnel__text">
        <span class="file-funnel__caption">
            Загрузить файлы
        </span>
        <span class="file-funnel__direction">
            Например: БТИ, экспликация (поэтажный план), эскиз планируемых работ (можно от руки)
        </span>
    </div>
    <div class="file-funnel__receiver">
        +
    </div>
    <div class="file-funnel__docs">
        <button type="button" class="file-funnel-btn file-funnel-btn--reset">Очистить</button>
    </div>
</div> */

export default class FileFunnel {

    constructor(elem, option = {
        deskBox: '.file-funnel__text',
        reciever: '.file-funnel__receiver',
        accept: ['.pdf', '.jpg', '.png'],
        docsBox: '.file-funnel__docs'
    }){
        this.funnel = elem; //основной контейнер
        this.description = document.querySelector(option.deskBox); //блок с текстом
        this.reveiver = document.querySelector(option.reciever); //блок в который загружаются файлы
        this.fileInput = ''; //инпут для файлов
        this.accept = option.accept; //массив с разрешенными расширениями
        this.docsBox = document.querySelector(option.docsBox);
        this.fileStorage = [];
        this.init();

    }
    init() {
        if (typeof this.funnel == 'string') {
            this.funnel = document.querySelector(this.funnel);
        } else if (typeof this.funnel == 'object') {

        } else {
            console.error('Ошибка FileFunnel. Передайте в параметре "elem" класс или объект')
            return 'error'
        }

        this.fileInput = this.funnel.querySelector('.file-funnel__file-input');

        // при клике на элемент открывается окно выбора файла
        this.funnel.addEventListener('click', () => {
            if(!this.docsBox.classList.contains('file-funnel__docs--show')){
                this.fileInput.click();
            }
        });

        this.reveiver.addEventListener('dragenter', (e) => {
            e.preventDefault();
            this.funnel.classList.add('file-funnel__dragenter');
        });
        this.reveiver.addEventListener("dragover", (e) => {
            e.preventDefault();
            // this.funnel.classList.add('file-funnel__dragenter');
        });
        this.reveiver.addEventListener('dragleave', (e) => {
            e.preventDefault();
            this.funnel.classList.remove('file-funnel__dragenter');
        });

        // обрабатываю данные файлов подгуженных перетаскиванием
        this.reveiver.addEventListener('drop', (e) => {
            e.preventDefault();
            this.funnel.classList.remove('file-funnel__dragenter');
            let arFiles = Array.from(e.dataTransfer.files);
            this.fileStorage = this.extensionFilter(arFiles);
            this.visualizeFiles(this.fileStorage);

        });

        // обрабатываю данные файлов подгуженных кликом
        this.fileInput.addEventListener('change', (e)=>{
            let arFiles = Array.from(e.target.files);
            this.fileStorage = this.extensionFilter(arFiles);
            this.visualizeFiles(this.fileStorage);
        });

        // клик на кнопку очистки
        let resetBtn = this.docsBox.querySelector('.file-funnel-btn--reset');
        if(resetBtn){
            resetBtn.addEventListener('click', (e)=>{
                e.stopPropagation();
                console.log("очищаем все")
                this.reset();
            })
        }
    }
     //добавление на страницу отображение отобранных файлов
    visualizeFiles(arr){
        if(arr.length > 0){
            this.docsBox.classList.add('file-funnel__docs--show');
            arr.forEach(item => {
                this.createFileElem(item);
            });
        }
    }

    // фильтрация файлов по указанным расширениям
    extensionFilter(arr){
        let arFilteredFiles = [];
        arr.forEach(item => {
            let extensionFile = this.getExtension(item.name);
            if (this.accept.includes(extensionFile)) {
                arFilteredFiles.push(item);
            }
        });
        return arFilteredFiles;
    }

    // создание элементов показывающих данных подгруженных файлы
    createFileElem(elem) {
        let fileHTML = `
            <div class="file-funnel-doc">
                <span class="file-funnel-doc__caption">${this.getFileName(elem.name)}</span>
                <span class="file-funnel-doc__extension-and-size"><span class="file-funnel-doc__extension">${this.getExtension(elem.name, true)}</span> (${this.getFIleSize(elem.size)}Кб)</span>
            </div>
        `;

        this.docsBox.insertAdjacentHTML('afterBegin', fileHTML);
    }

    // принимает строку с названием и расширением файла и возвращает его расширение
    getExtension(str, deletePoint = false) {
        if(deletePoint){
            let s = str.match(/\.[0-9a-z]+$/i)[0];
            return s.slice(1);
        }else{
            return str.match(/\.[0-9a-z]+$/i)[0];
        }

    }

    // принимает строку с названием и расширением файла и возвращает его название
    getFileName(str) {
        return str.match(/(.*)\.[^.]+$/i)[1];
    }

    getFIleSize(size){
        let n = Number(size) / 1024;
        return n.toFixed(2);
    }
    // возвращает данные подгруженных файлов.
    getUploadedFiles(){
        return this.fileStorage;
    }
    // очистка
    reset(){
        console.log(this.funnel.value)

        this.fileStorage = [];
        let nlVizFiles = this.docsBox.querySelectorAll('.file-funnel-doc');
        if(nlVizFiles.length > 0){
            nlVizFiles.forEach(item=>{
                item.remove();
            });

            console.log(this.funnel.files)
        }
        this.docsBox.classList.remove('file-funnel__docs--show');
    }

}
