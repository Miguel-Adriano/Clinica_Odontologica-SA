// Função para aplicar a máscara de telefone
document.getElementById('telefone').addEventListener('input', function(e) {
    let input = e.target;
    let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

    // Aplica a máscara conforme o número de caracteres
    if (value.length <= 2) {
        input.value = value.replace(/^(\d{0,2})/, '$1');
    } else if (value.length <= 6) {
        input.value = value.replace(/^(\d{2})(\d{0,5})/, '$1 $2');
    } else {
        input.value = value.replace(/^(\d{2})(\d{5})(\d{0,4})/, '$1 $2-$3');
    }
});

// Função para aplicar a máscara de CPF
document.addEventListener('DOMContentLoaded', function() {
    const cpfInput = document.getElementById('cpf');
    
    cpfInput.addEventListener('input', function(e) {
        let input = e.target;
        let value = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

        // Aplica a máscara no formato 000.000.000-00
        if (value.length <= 3) {
            input.value = value.replace(/^(\d{0,3})/, '$1');
        } else if (value.length <= 6) {
            input.value = value.replace(/^(\d{3})(\d{0,3})/, '$1.$2');
        } else if (value.length <= 9) {
            input.value = value.replace(/^(\d{3})(\d{3})(\d{0,3})/, '$1.$2.$3');
        } else {
            input.value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d{0,2})/, '$1.$2.$3-$4');
        }
    });
});
