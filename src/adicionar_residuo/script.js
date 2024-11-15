document.getElementById('imgResiduo').addEventListener('change', function(event) {
    const file = event.target.files[0]; // Obtém o arquivo selecionado
    const preview = document.getElementById('preview');
    
    if (file) {
        const reader = new FileReader();
        
        // Quando o arquivo for carregado, definimos o src da imagem de preview
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; // Torna a imagem visível
        };
        
        reader.readAsDataURL(file); // Lê o arquivo como URL para exibição
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
});
