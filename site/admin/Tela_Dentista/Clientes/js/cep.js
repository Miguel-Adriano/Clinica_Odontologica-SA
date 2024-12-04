// Função para aplicar a máscara de CEP
document.getElementById('cep').addEventListener('input', function(e) {
    let input = e.target;
    let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

    // Aplica a máscara no formato XXXXX-XXX
    if (value.length <= 5) {
        input.value = value.replace(/^(\d{0,5})/, '$1');
    } else {
        input.value = value.replace(/^(\d{5})(\d{0,3})/, '$1-$2');
    }
});