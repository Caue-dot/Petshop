const fileInput = document.getElementById('file');
    const preview = document.getElementById('preview');

    fileInput.addEventListener('change', function () {
      const file = this.files[0];
      
      if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        console.log(file);
        reader.onload = (e) => {
          preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
      } 
});