const phoneInput = document.getElementById("phone");

  phoneInput.addEventListener("input", function (e) {
    let value = e.target.value.replace(/\D/g, ""); // Remove caracteres não numéricos
    value = value.replace(/^(\d{2})(\d)/g, "+$1 $2");       // Adiciona o código do país
    value = value.replace(/(\d{2})(\d)/, "$1 $2");         // Adiciona o DDD
    value = value.replace(/(\d{5})(\d{4})$/, "$1-$2");     // Adiciona o hífen

    e.target.value = value.slice(0, 17); // Limita o comprimento máximo
  });