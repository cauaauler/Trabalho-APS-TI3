document.getElementById('imgResiduo').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    } 
});
const colorMap = {
    1: '#989800',     
    2: '#3737ff',   
    3: '#e14040',    
    4: '#6f3828',        
};

document.getElementById('selectTipoResiduo').addEventListener('change', function () {
    const selectedValue = this.value; 
    const selectedColor = colorMap[selectedValue]; 
    
    // Altera a cor de fundo e a cor do texto do select
    this.style.backgroundColor = selectedColor || 'white'; 
    this.style.color = selectedValue === 'organico' ? 'black' : 'white';
    this.style.color = selectedValue[0] == 'black';
});
