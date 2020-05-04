<html>
<head>
	<meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title></title>
    <style>
        .input {
            display: flex; 
            align-items: center;
        }
        input {
            width: 100%;
            font: inherit;
            padding: 0.25em 0.5em;
            border: 0.125em solid hsl(30, 76%, 10%); 
            outline: none;
        }

    </style>
</head>
<body>
    <h1>Sprawdzanie poprawności numeru PESEL</h1>
    Wprowadź PESEL: <input type="text" id="pesel" name="pesel" maxlength="11" required placeholder="Wpisz PESEL"><br>
    <button onclick="funkcja()">Sprawdź</button><br><br><br>
    Żółte tło - zbyt krótki pesel<br>
    Czerwona obramówka - zły numer kontrolny<br>
    Zielona obramówka - prawidłowy numer pesel<br>
</body>
<script>
    var zbyt_krotkie, zly_nr;
    function sprawdzPESEL(pesel) {
    var reg = /^[0-9]{11}$/;
    if(reg.test(pesel) == false) 
		return false;
    else
    {
        var digits = (""+pesel).split("");
		// if ((parseInt(pesel.substring( 4, 6)) > 31)||(parseInt(pesel.substring( 2, 4)) > 12))
		// 	return false;
		
        var checksum = (1*parseInt(digits[0]) + 3*parseInt(digits[1]) + 7*parseInt(digits[2]) + 9*parseInt(digits[3]) + 1*parseInt(digits[4]) + 3*parseInt(digits[5]) + 7*parseInt(digits[6]) + 9*parseInt(digits[7]) + 1*parseInt(digits[8]) + 3*parseInt(digits[9]))%10;
        if(checksum==0) checksum = 10;
			checksum = 10 - checksum;

        return (parseInt(digits[10])==checksum);
    }
}
    function funkcja(){
        var nr_pesel = document.getElementById('pesel').value;
        if (nr_pesel.length < 11){
            zbyt_krotkie = true;
        } else {
            zbyt_krotkie = false;
        }
        if(zbyt_krotkie){
            document.getElementById('pesel').style.backgroundColor = 'yellow';
        }
        if(!zbyt_krotkie){
            document.getElementById('pesel').style.backgroundColor = 'white';
        }
        if(sprawdzPESEL($("#pesel").val())){
            document.getElementById('pesel').style.borderColor = 'green';
			console.log('true');
			setTimeout(function(){
                window.open("http://localhost/kpesel/insert.php?pesel=" + $("#pesel").val());
            }, 1000);
		} else {
            document.getElementById('pesel').style.borderColor = 'red';
			console.log('false');
        }
    }
</script>
</html>