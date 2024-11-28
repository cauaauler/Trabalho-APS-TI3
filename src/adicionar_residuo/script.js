const colorMap = {
    1: '#b3b300',     
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
document.getElementById('imgResiduo').addEventListener('change', function () {
    const fileName = this.files[0] ? this.files[0].name : 'Nenhum arquivo selecionado';
    document.getElementById('fileName').textContent = fileName;
});

