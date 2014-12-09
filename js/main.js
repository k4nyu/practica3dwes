window.addEventListener("load", function(){
    
    var borrar= document.getElementsByClassName("borrar");
    for(var i=0; borrar.length;i++){
        borrar[i].addEventListener("click", confirmar);
    }
    var editar= document.getElementsByClassName("editar");
    for(var i=0; editar.length;i++){
        if(editar[i]){
            editar[i].addEventListener("click", modificar);
        }
    }
    
});

function confirmar(e){
    var nombre= e.currentTarget.getAttribute("data-nombre");
    var respuesta= confirm("¿Seguro que quieres borrar este elemento?");
    if(!respuesta){
        e.preventDefault();
    }
}
function modificar(e){
    e.preventDefault();
    var id= e.currentTarget.getAttribute("data-id");
    var f =document.getElementById("formulario");
    f.action="viewedit.php";
    var idformulario= document.getElementById("idformulario");
    idformulario.value=id;
    f.submit();
}