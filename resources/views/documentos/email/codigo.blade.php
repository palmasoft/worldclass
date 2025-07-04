<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codigo de Autorizacion</title>
</head>
<body>
    <style>
        .jc-container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        .jc-row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .jc-col-12 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;

            
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }

        .jc-card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
        }

        .jc-card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .jc-card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }
    </style>
    <div class="jc-container">
        <div class="jc-row">
            <div class="jc-col-12">
                <div class="jc-card">
                    <div class="jc-card-header">
                        Codigo de Autorizacion
                    </div>
                    <div class="jc-card-body">
                        <p>
                            Entregue este codigo de autorizacion a quien se lo solicite para la generacion del documento de anulacion legal del contrato 
                            <strong>
                                {{ @$contrato }}
                            </strong>. 
                        </p>
                        <p>
                            Codigo: <strong>
                                {{ @$codigo }}
                            </strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>