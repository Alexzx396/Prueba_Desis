<style>

    .container {
      display: flex;
      flex-direction: column;
      height: 100vh;
      justify-content: center;
      align-items: center;
    }

    .formulario {
      border: 1px solid #ccc;
      padding: 50px;
      display: flex;
      flex-wrap: wrap;
      max-width: 600px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      justify-content: space-between;
    }

    .form-group {
      display: flex;
      flex-basis: 100%;
      margin-bottom: 15px;
      align-items: center;
    }

    .form-group label {
      flex-basis: 37%;
      margin-right: 10px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      flex-basis: 58%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .form-group input:hover,
    .form-group input:focus,
    .form-group select:hover,
    .form-group select:focus,
    .form-group textarea:hover,
    .form-group textarea:focus {
      border-color: #888;
    }

    .form-group.submit-button {
      margin-top: 50px;
    }

    button {
      padding: 10px 15px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .alerta {
      padding: 10px;
      color: white;
      border-radius: 5px;
      margin-bottom: 20px;
      text-align: center;
    }

    .alerta.error {
      background-color: red;
    }

    .alerta.exito {
      background-color: green;
    }

    .alerta.informacion {
      background-color: blue;
    }


 </style>