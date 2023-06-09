const btnUpdate = document.getElementById("btnOpenAlert")
const btnDelete = document.getElementById("btnBorrar")

btnUpdate.addEventListener('click', () => {
    Swal.fire(
    'Updated!',
    'The course has been updated.',
    'success'
    )
})

btnDelete.addEventListener('click', () => {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this course?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        html: "<br><br><button type='button' class='btn btn-danger' onclick='eliminarCurso()'>Delete Course</button>"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
})