export function setBodyClass (className) {
  document.body.setAttribute('class', className)
}

export function setTitle (title) {
  const $title = document.getElementsByTagName('title')
  $title[0].innerHTML = title
}
