const table = document.querySelector('table')
const save = document.getElementById('save')
const show = document.getElementById('show')
const storage = window.localStorage

show.onclick = function (e) {
    e.preventDefault()
    storage.getItem('table') ?
        (table ?
            table.outerHTML = storage.getItem('table') :
            document.querySelector('body').innerHTML += storage.getItem('table')) :
        alert('localStorage пуст!')
}
save.onclick = function (e) {
    e.preventDefault()
    table ? storage.setItem('table', table.outerHTML) : alert('Нечего добавить!')
}