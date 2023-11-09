<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/spinner/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>API Clients</title>
</head>
<body>
    <div class="container">
    <br><h1 class="text-center">API de Clientes</h1><br><br>
        <table class="table">
            <thead>
              <tr class="table-dark">
                <th scope="col">METHOD</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">EXAMPLE</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <tr>
                <th scope="row">get_all_clients</th>
                <td>Este método se utiliza para obtener la lista de todos los clientes. Debes hacer una solicitud <b>GET</b> a la ruta <b>/all_clients</b> para obtener la lista completa.</td>
                <td>http://localhost/API_PDO/all_clients </td>
              </tr>
              <tr>
                <th scope="row">create_client</th>
                <td>Utiliza una solicitud <b>POST</b> a la ruta <b>/create_client</b> para crear un nuevo cliente. Debes enviar los datos del cliente en el cuerpo de la solicitud en formato JSON.</td>
                <td>
                    http://localhost/API_PDO/create_client <br><br>
                    <b>Body>raw>JSON</b><br>
                    {
                        "name": "Nuevo cliente",
                        "email": "Nuevo correo electrónico",
                        "city": "Nueva Ciudad",
                        "telephone": "Nuevo número de teléfono"
                    }
                </td>
            </tr>
              <tr>
                <th scope="row">update_client</th>
                <td>Utiliza una solicitud <b>PUT</b> a la ruta <b>/update_client</b> para actualizar un cliente existente por su ID. Debes enviar los nuevos datos del cliente en el cuerpo de la solicitud en formato JSON.</td>
                <td>
                    http://localhost/API_PDO/update_client <br><br>
                    <b>Body>raw>JSON</b><br>
                    {
                        "id": "El ID del cliente",
                        "name": "Nuevo nombre del cliente",
                        "email": "Nuevo correo electrónico",
                        "city": "Nueva Ciudad",
                        "telephone": "Nuevo número de teléfono"
                    }
                </td>
              </tr>
              <tr>
                <th scope="row">delete_client_by_id</th>
                <td>Utiliza una solicitud <b>DELETE</b> a la ruta <b>/delete_client</b> para eliminar un cliente por su ID.</td>
                <td>
                    http://localhost/API_PDO/delete_client <br><br>
                    <b>Body>raw>JSON</b><br>
                    {
                        "id": 11
                    }
                </td>
              </tr>
              <tr>
                <th scope="row">search_client_by_id</th>
                <td>Utiliza una solicitud <b>GET</b> a la ruta <b>/search_client</b> para buscar un cliente por su ID.</td>
                <td>http://localhost/API_PDO/search_client <br><br>
                    <b>Body>raw>JSON</b><br>
                    {
                        "id": 11
                    }
                </td>
              </tr>
            </tbody>
          </table>
    </div>


<div class="body-spinner" id="spinner">
    <div class="spinner">
        <div class="dot1"></div>
        <div class="dot2"></div>
    </div>
</div>
<script src="/spinner/spinner.js"></script>
</body>
</html>