function consultar_header()	{
	 let obj = {
      "action" : "consultar_header"
    };

        $.post('includes/_funciones.php', obj, function(r) {
     let template = ``;
    $.each(r, function(i, e) {
    template += `
            <tr>
              <td>${e.nombre_usr}</td>
              <td>${e.telefono_usr}</td>
              <td>
                <a href="#" data-id="${e.id_usr}">Editar</a>
                <a href="#" data-id="${e.id_usr}">Eliminar</a>
              </td>
            </tr>
          `;
    });
    $("#list_usuarios tbody").html(template);
  }, "JSON")

}