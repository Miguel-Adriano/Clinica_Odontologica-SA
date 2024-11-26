const cpfInput = document.getElementById('cpf');

    cpfInput.addEventListener('input', function () {
        let value = cpfInput.value.replace(/\D/g, ''); // Remove tudo que não é número
        if (value.length > 11) value = value.substring(0, 11); // Limita a 11 caracteres

        // Adiciona os pontos e traço no CPF
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

        cpfInput.value = value;
    });