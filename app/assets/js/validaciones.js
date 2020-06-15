function validartexto200(cad)
{
    var valtxt = "^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ,;:_/* +.-\s]{1,200}$";
    return cad.match(valtxt) ? true : false;
}
function validartexto255(cad)
{
    var valtxt = "^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ,;:_/* +.-\s]{1,255}$";
    return cad.match(valtxt) ? true : false;
}
function validartexto50(cad)
{
    var valtxt = "^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ,;:_/* +.-\s]{1,50}$";
    return cad.match(valtxt) ? true : false;
}
function validardesc(cad)
{
    var valtxt = "^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ,;:_/* +.-\s]{1,16777215}$";
    return cad.match(valtxt) ? true : false;
}
function validarimg(cad)
{
    var valtxt = "^[a-zA-Z0-9áéíóúñÁÉÍÓÚÑ,;:_/* +.-\s]{1,255}$";
    return cad.match(valtxt) ? true : false;
}
function validarnumero2(cad)
{
    var valnum = "^[0-9]{1,2}$";
    return cad.match(valnum) ? true : false;
}
function validarnumero5(cad)
{
    var valnum = "^[0-9]{1,5}$";
    return cad.match(valnum) ? true : false;
}
function validarnumero4(cad)
{
    var valnum = "^[0-9]{1,4}$";
    return cad.match(valnum) ? true : false;
}
function validaremail(cad)
{
    var valemail = "^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{1,150}";
    return cad.match(valemail) ? true : false;
}