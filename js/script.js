function flatAlert(titolo, testo, icona, url){
  swal({
    title: titolo,
    text: testo,
    icon: icona,
  }).then(azione => {
    if (azione){
      location.href = url;
    }else{
      location.href = url;
    }
  });
}
function flatAlertClose(titolo, testo, icona){
  swal({
    title: titolo,
    text: testo,
    icon: icona,
  }).then(azione => {
    if (azione){
      window.close();
    }else{
      window.close();
    }
  });
}
function alertDeleteReport(id){
  swal(
    {
      title: "Vuoi continuare?",
      text: "Perderai tutti i dati relativi al rapporto d'intervento",
      icon: "error",
      buttons: {
        cancel: {
          text: "Annulla",
          visible: true,
        },
        button: {
          text: "Continua",
          visible: true,
        }
      }
    }
  ).then(Elimina => {
    if (Elimina){
      swal(" ", "Rapporto eliminato con successo", "success").then(Elimina => {
        location.href='core/deleteReport.php?id='+id;
      });
    }else{
      swal.close();
    }
  });
}
