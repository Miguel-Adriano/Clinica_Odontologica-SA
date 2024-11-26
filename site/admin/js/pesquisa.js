function pesquisar(element, get) {
    input = element.value;
    // alert(input);
    window.location.href = "pesquisa_dinamica.php?pesquisa=" + input;
}