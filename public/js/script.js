function confirmExit() {
    let answer = confirm("Confirmar saída do evento?")
    if(answer){
        document.forms['frmExit'].submit()
        return true
    } else {
        event.preventDefault()
        return false
    }
}

function confirmDelete() {
    let answer = confirm("Deseja excluir este evento?")
    if(answer){
        document.forms['frmDelete'].submit()
        return true
    } else {
        event.preventDefault()
        return false
    }
}


 