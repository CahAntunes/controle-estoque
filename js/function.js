
function definirDataMinima(idInput) {
    // Obter a data atual
    var today = new Date();
    
    // Formatar a data no formato YYYY-MM-DD
    var minDate = today.toISOString().split('T')[0];
    
    // Definir o atributo 'min' do input 'date'
    document.getElementById(idInput).min = minDate;
}
