window.addEventListener('DOMContentLoaded', () => {
  
  // image preview
  const image = document.querySelector('.image-preview');
  const inputFileButton = document.querySelector('#gambar');
  inputFileButton.addEventListener('change', function() {
    const file = this.files[0];
    getExtension(file);
  });
  
  function getExtension(file) {
    const extensionValid = ['jpg', 'png', 'gif', 'jpeg'];
    const part = file.name.split('.');
    const extension = part[part.length - 1].toLowerCase();
    extensionValid.forEach(valid => {
      if (valid.indexOf(extension) != -1) return previewImage(file);
    });
  }
  
  function previewImage(file) {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => image.setAttribute('src', reader.result);
  }
  
});