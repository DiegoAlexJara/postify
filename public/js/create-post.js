function updateCharCount() 
{
    var textarea = document.getElementById('content');
    var maxLength = textarea.getAttribute('maxlength');
    var currentLength = textarea.value.length;
    var charCount = document.getElementById('charCount');
    var textarea1 = document.getElementById('content1');
    var maxLength1 = textarea1.getAttribute('maxlength');
    var currentLength1 = textarea1.value.length;
    var charCount1 = document.getElementById('charCount1');
    charCount.textContent = (maxLength - currentLength) + ' Caracteres Restantes';
    charCount1.textContent = (maxLength1 - currentLength1) + ' Caracteres Restantes';
}