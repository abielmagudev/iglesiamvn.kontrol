@push('scripts')
<script>
const rellenarUsuario = {
    inputEmail: document.getElementById('inputCorreoElectronico'),
    inputName: document.getElementById('inputUsuario'),
    listen: function () {
        let self = this

        this.inputEmail.addEventListener('blur', (e) => {
            if( self.inputName.value.trim() == '' )
            {
                self.inputName.value = (e.target.value.split('@'))[0].trim()
            }
        })
    }
}
rellenarUsuario.listen()
</script>    
@endpush
