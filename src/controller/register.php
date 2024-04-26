<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Ouvidoria Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

</head>
<body>
<div class="container">
    <h2>Cadastro</h2>
    <form id="signupForm" method="POST" action="../../public/index.php">
        <div class="form-group">
            <label for="fullName">Nome Completo:</label>
            <input type="text" class="form-control" id="fullName" name="fullName" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirme a Senha:</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
        </div>

        <div class="form-group">
            <label for="birthdate">Data de Nascimento:</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" required>
        </div>


        <!-- Campo de Telefone -->
        <div class="form-group">
            <label for="phone">Telefone:</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>

        <!-- Campo de WhatsApp -->
        <div class="form-group">
            <label for="whatsapp">WhatsApp:</label>
            <input type="tel" class="form-control" id="whatsapp" name="whatsapp" required>
        </div>

        <!-- Ajuste nos campos de Estado e Cidade para Carregamento Dinâmico -->
        <div class="form-group">
            <label for="state">Estado:</label>
            <select id="state" class="form-control" name="state" required>
                <option value="">Selecione um Estado</option>
                <option value="">Santa Catarina</option>
                <!-- Opções de estados serão carregadas aqui -->
            </select>
        </div>

        <div class="form-group">
            <label for="city">Cidade:</label>
            <select id="city" class="form-control" name="city" required>
                <option value="">Selecione uma Cidade</option>
                <option value="">Criciúma</option>
                <!-- Opções de cidades serão carregadas aqui baseadas no Estado selecionado -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<script>
    // Validações de senha
    $(document).ready(function() {
        $("#signupForm").submit(function(event) {
            // Prevent the form from submitting via the browser.
            event.preventDefault();

            var password = $("#password").val();
            var confirmPassword = $("#confirmPassword").val();

            // Verifique se as senhas coincidem
            if(password !== confirmPassword) {
                alert("As senhas não coincidem!");
                return false; // Impede o envio do formulário
            }

            // Outras validações podem ser adicionadas aqui

            // Se tudo estiver correto, envie o formulário
            this.submit();
        });
    });

    // Máscaras, validações e AJAX para carregar estados e cidades
    // Adicionada validação para verificar se o usuário tem mais de 18 anos
    $('#birthdate').change(function(){
        var birthdate = new Date($(this).val());
        var ageDifMs = Date.now() - birthdate.getTime();
        var ageDate = new Date(ageDifMs); // miliseconds from epoch
        var age = Math.abs(ageDate.getUTCFullYear() - 1970);
        if (age < 18) {
            alert("Você deve ter mais de 18 anos.");
            $('#birthdate').val(''); // Limpa o campo
        }
    });


    // Máscara de telefones
    $(document).ready(function(){
        // Máscaras de telefone e WhatsApp
        $('#phone, #whatsapp').mask('(00) 00000-0000');

        // Restante do código de validação...
    });

    // Carregando estados
    $(document).ready(function(){
        $.ajax({
            url: 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var select = $("#state");
                select.empty(); // Limpar os estados existentes
                select.append('<option value="">Selecione um Estado</option>'); // Opção padrão
                $.each(data, function(i, state) {
                    select.append($('<option>').text(state.nome).attr('value', state.sigla));
                });
            }
        });
    });

    $("#state").change(function() {
        var state = $(this).val();
        var citiesSelect = $("#city");

        if(state) {
            $.ajax({
                url: `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${state}/municipios`,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    citiesSelect.empty(); // Limpar as cidades existentes
                    citiesSelect.append('<option value="">Selecione uma Cidade</option>'); // Opção padrão
                    $.each(data, function(i, city) {
                        citiesSelect.append($('<option>').text(city.nome).attr('value', city.nome));
                    });
                }
            });
        } else {
            citiesSelect.empty();
            citiesSelect.append('<option value="">Selecione uma Cidade</option>');
        }
    });
</script>


</body>
</html>
