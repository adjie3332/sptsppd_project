<script>
     // pegawai
     const wrapperFields = document.querySelector('#pegawai-wrapper');
        const addPegawaiButton = document.querySelector('#add-pegawaib-button');
        const removePegawaiButton = document.querySelector('#remove-pegawaib-button');
        const pegawais = [];
    
        const template = (position) =>`<div class="form-group">
                <label>Pegawai ${position}</label>
                <select class="js-example-basic-multiple w-100" name="pegawaib[]"
                    id="pegawaib">
                    '@foreach($biaya as $s) <option value="{{ $s->id }}">{{$s->name}}</option> @endforeach
                </select>
            </div>`
        addPegawaiButton.addEventListener('click', () => {
            const lastChild = wrapperFields.querySelector('.form-group:last-child')
            const currentLength =  wrapperFields.children.length;
            // console.log(wrapperFields)
            lastChild.insertAdjacentHTML('afterend', template(currentLength + 1));    
        })
    
        removePegawaiButton.addEventListener('click', () => {
            const lastChild = wrapperFields.querySelector('.form-group:last-child')
            const currentLength =  wrapperFields.children.length;
            // console.log(wrapperFields)
            if (currentLength != 1) {
                lastChild.remove(template); 
            }
        })

        // uang_harian
        const ambilHarian = document.querySelector('#harian-wrapper');
        const addHarianButton = document.querySelector('#add-harianButton');
        const removeHarianButton = document.querySelector('#remove-harianButton');
        const harians = [];

        const templatee = (position) =>`<div class="form-group">
                <label>Uang Harian ${position}</label>
                    <input type="text" class="form-control" id="uang_harian" name="uang_harian[]" 
                    placeholder="Tulis Nominal Uang Transport">
            </div>`
        addHarianButton.addEventListener('click', () => {
            const lastChild = ambilHarian.querySelector('.form-group:last-child')
            const currentLength =  ambilHarian.children.length;
            // console.log(ambilHarian)
            lastChild.insertAdjacentHTML('afterend', templatee(currentLength + 1));    
        })
    
        removeHarianButton.addEventListener('click', () => {
            const lastChild = ambilHarian.querySelector('.form-group:last-child')
            const currentLength =  ambilHarian.children.length;
            // console.log(ambilHarian)
            if (currentLength != 1) {
                lastChild.remove(templatee); 
            }
        })

        // uang_transport
        const ambilHariant = document.querySelector('#hariant-wrapper');
        const addHariantButton = document.querySelector('#add-hariantButton');
        const removeHariantButton = document.querySelector('#remove-hariantButton');
        const hariants = [];

        const templateee = (position) =>`<div class="form-group">
                <label>Uang Transport ${position}</label>
                    <input type="text" class="form-control" id="uang_transport" name="uang_transport[]" 
                    placeholder="Tulis Nominal Uang Transport">
            </div>`
        addHariantButton.addEventListener('click', () => {
            const lastChild = ambilHariant.querySelector('.form-group:last-child')
            const currentLength =  ambilHariant.children.length;
            // console.log(ambilHarian)
            lastChild.insertAdjacentHTML('afterend', templateee(currentLength + 1));    
        })
    
        removeHariantButton.addEventListener('click', () => {
            const lastChild = ambilHariant.querySelector('.form-group:last-child')
            const currentLength =  ambilHariant.children.length;
            // console.log(ambilHarian)
            if (currentLength != 1) {
                lastChild.remove(templateee); 
            }
        })


        // biaya_transport
        const ambilTransport = document.querySelector('#transport-wrapper');
        const addTransportButton = document.querySelector('#add-transportButton');
        const removeTransportButton = document.querySelector('#remove-transportButton');
        const transports = [];

        const templateeee = (position) =>`<div class="form-group">
                <label>Biaya Transport ${position}</label>
                    <input type="text" class="form-control" id="biaya_transport" name="biaya_transport[]" 
                    placeholder="Tulis Nominal Biaya Transport">
            </div>`
        addTransportButton.addEventListener('click', () => {
            const lastChild = ambilTransport.querySelector('.form-group:last-child')
            const currentLength =  ambilTransport.children.length;
            // console.log(ambilHarian)
            lastChild.insertAdjacentHTML('afterend', templateeee(currentLength + 1));    
        })
    
        removeTransportButton.addEventListener('click', () => {
            const lastChild = ambilTransport.querySelector('.form-group:last-child')
            const currentLength =  ambilTransport.children.length;
            // console.log(ambilHarian)
            if (currentLength != 1) {
                lastChild.remove(templateeee); 
            }
        })
</script>