var q = document.getElementById('q');
var a1 = document.getElementById('a1');
var a2 = document.getElementById('a2');
var a3 = document.getElementById('a3');
var a4 = document.getElementById('a4');
var btn = document.getElementById('btn');
var select1 = document.getElementById('select1');
var select2 = document.getElementById('select2');
var select3 = document.getElementById('select3');
var select4 = document.getElementById('select4');
var result = document.getElementById('result');

// onclick, add to database
btn.addEventListener('click', function(){
    // setup AJAX
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200) {
            result.innerHTML = 'Added to database!';
            console.log(this.response);
            
            // clear the form
            q.value = '';
            a1.value = '';
            a2.value = '';
            a3.value = '';
            a4.value = '';
            select1.checked = false;
            select2.checked = false;
            select3.checked = false;
            select4.checked = false;
        }
    }
    
    // put items to send in a FormData object
    var data = new FormData();
    data.append('q', q.value);
    data.append('a1', a1.value);
    data.append('a2', a2.value);
    data.append('a3', a3.value);
    data.append('a4', a4.value);
    
    if (select1.checked) {
        data.append('answer', select1.value);
    } else if (select2.checked) {
        data.append('answer', select2.value);
    } else if (select3.checked) {
        data.append('answer', select3.value);
    } else if (select4.checked) {
        data.append('answer', select4.value);
    }
    
    xhttp.open('POST', '../PHP/POST_question.php', true);
    xhttp.send(data);
});