const inputs = document.querySelectorAll("[data-input-file]")

if (inputs.length > 0) {
  for (const input of inputs) {
    const resId = input.dataset.inputFile
    const res = document.getElementById(resId)

    input.addEventListener("change", (event) => {
      const files = event.target.files
      const fileName = files.length > 0
        ? `Выбрано фото: ${files[0].name}`
        : "Добавить фото"
      res.textContent = fileName
    })
  }
}
