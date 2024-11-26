const cepInput = document.getElementById('cep');

    cepInput.addEventListener('input', function () {
        let value = cepInput.value.replace(/\D/g, ''); // Remove tudo que não for número
        if (value.length > 8) value = value.substring(0, 8); // Limita a 8 caracteres (CEP tem 8 números)

        // Adiciona o hífen na posição correta
        if (value.length > 5) {
            value = value.replace(/(\d{5})(\d{1,3})/, '$1-$2');
        }

        cepInput.value = value;
    });