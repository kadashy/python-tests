	{****************************************************************************************************************************************************************************}


{if ($employee->id)==1}
    	<div>
	<h3>KARDEX</h3>
	
<INPUT type="button" value="Agregar nuevo ingreso" onclick="ejecutarboton(1,0)" />
<INPUT type="button" id="{$product->id}" value="Mostrar historial" onclick="ejecutarboton(2,(this.id))" />
<INPUT type="button" id="{$product->id}" value="Editar casilla" onclick="ejecutarboton(3,(this.id))" />
<INPUT type="button" value="Modificar casilla seleccionada" onclick="ejecutarboton(4,0)" />

<input type="hidden" name="webcampics" value="{$product->id}">


<div id="txtHint"><b></b></div>

<script>
function ejecutarboton(idice_del_boton,str) 
{
	if(idice_del_boton == 1)
	{
		ingreso(0);
	}

	else if(idice_del_boton == 2)
	{
		Mostrar_historial(str);
	}

	else if(idice_del_boton == 3)
	{
		ingreso(1,str);
	}

	else if(idice_del_boton == 4)
	{
		ingreso(2);
	}

	else
	{}
}
</script>


</SCRIPT>

</p>
<script>

function Mostrar_historial(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","buscar.php?q="+str+"&box_a_modificar="+0,true);
        xmlhttp.send();
    }
}
</script>
<div id="txtHint"><b></b></div>



<p id="demo"></p>
<script>
function ingreso(agregar_o_modificar,str) 
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() 
	{
    	if (xhttp.readyState == 4 && xhttp.status == 200) 
    	{
      		document.getElementById("demo").innerHTML = xhttp.responseText;
    	}
  	};

	
  	if(agregar_o_modificar == 0 )
  	{
  		var names = [];
		var elem = document.getElementsByName("webcampics");

		for (var i = 0; i < elem.length; ++i) 
		{
     		names.push(elem[i].value);	
		}
		var se_esta_editanto_casilla=0;
		xhttp.open("GET", "modificar.php?q="+names[0]+"&Costo="+names[1]+"&Proveedor="+names[2]+"&Cambio="+names[3]+"&Cantidad="+names[4]+"&Peso="+names[5]+"&Fecha="+names[6] +"&casilla_a_modificar="+0+"&se_esta_editanto_casilla="+0+"&auxiliar_casilla_a_editar="+0, true);
		xhttp.send();

		alert("agregar ");
	}


	if(agregar_o_modificar == 1)
	{
		var table = document.getElementsByName("sel");
		var valores = [];
		var zero=0;
		var casilla_a_modificar;
		var rowCount = table.length
		for (var i = 0; i < table.length; ++i) 
		{
     		valores.push(table[i].value);	
     		if(true == table[i].checked) 
     		{
				casilla_a_modificar=(i);
            }
		}
		alert("modificar ");
		alert(str);
		xhttp.open("GET", "modificar.php?casilla_a_modificar="+(casilla_a_modificar+1)+"&q="+str+"&se_esta_editanto_casilla="+1+"&auxiliar_casilla_a_editar="+0,true );
		xhttp.send();
	}

	if(agregar_o_modificar == 2)
	{
		var table = document.getElementsByName("sel");
		var valores = [];
		var zero=0;
		var auxiliar_casilla_a_editar;
		var rowCount = table.length
		for (var i = 0; i < table.length; ++i) 
		{
     		valores.push(table[i].value);	
     		if(true == table[i].checked) 
     		{
				auxiliar_casilla_a_editar=(i+1);
            }
		}

  		var names = [];
		var elem = document.getElementsByName("webcampics");

		for (var i = 0; i < elem.length; ++i) 
		{
     		names.push(elem[i].value);	
		}
		alert("se va a modificar un registro");
		xhttp.open("GET", "modificar.php?q="+names[0]+"&Costo="+names[1]+"&Proveedor="+names[2]+"&Cambio="+names[3]+"&Cantidad="+names[4]+"&Peso="+names[5]+"&Fecha="+names[6] +"&casilla_a_modificar="+0+"&se_esta_editanto_casilla="+1+"&auxiliar_casilla_a_editar="+auxiliar_casilla_a_editar, true);
		xhttp.send();

	} 

}
</script>
<p id="demo"></p>
<script>
function p() 
{
		var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() 
	{
    	if (xhttp.readyState == 4 && xhttp.status == 200) 
    	{
      		document.getElementById("demo").innerHTML = xhttp.responseText;
    	}
  	};
		xhttp.open("GET", "isLogged.php?q="+1, true);
		xhttp.send();
		alert("enviado");
}
</script>
<p id="demo"></p>
</div>
{else}

{/if}





{****************************************************************************************************************************************************************************}