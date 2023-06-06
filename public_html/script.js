const archivos = document.getElementById('archivos');

archivos.addEventListener('change',function( e ) {
    console.log ( archivos.files );
    const FD = new FormData( );
    for (let file of archivos.files ){
        FD.append( 'files[]',file)
    }
    fetch( 'upload.php' , { method:'POST',body:FD } ).
    then ( rta => rta.json() ).
    then( json => {
        console.log( json );
    }).
    catch (e => {console.error(e);});
});