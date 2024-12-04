// Obtém os elementos da página
const frm = document.querySelector("form")
const resp = document.querySelector("h3")

frm.addEventListener("submit", (e) => {
    e.preventDefault(); // Evita o envio do formulário
    const senha = frm.senha.value; // Obtém a senha digitada
    const erros = []; // Vetor que armazena os erros

    // Verifica se o tamanho da senha é inválido
    if (senha.length < 8 || senha.length > 15) {
        erros.push("deve possuir entre 8 e 15 caracteres");
    }

    // Verifica se a senha não possui números
    if (senha.match(/[0-9]/g) == null) {
        erros.push("deve possuir números (no mínimo 1 número)");
    }

    // Verifica se não há letras minúsculas
    if (!senha.match(/[a-z]/g)) {
        erros.push("deve possuir letras minúsculas (no mínimo 1 letra minúscula)");
    }

    // Verifica se não há letras maiúsculas ou se possui apenas 1
    if (!senha.match(/[A-Z]/g) || senha.match(/[A-Z]/g).length == 1) {
        erros.push("deve possuir letras maiúsculas (no mínimo 2)");
    }

    // Verifica se não há símbolos
    if (!senha.match(/[\W|_]/g)) {
        erros.push("deve possuir símbolos (no mínimo 1 símbolo)");
    }

    // Verifica se o vetor de erros está vazio
    if (erros.length == 0) {
        resp.innerText = "Senha Válida";
        frm.submit(); // Se não houver erros, permite o envio do formulário
    } else {
        resp.innerText = `Erro... A senha ${erros.join(", ")}`;
    }
});