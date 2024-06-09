# Trabalho Integrador - Gestão de Frota de Veículos

## Alunos
- João Silva - Matrícula: 202123456
- Maria Oliveira - Matrícula: 202123457
- Pedro Santos - Matrícula: 202123458
- Ana Costa - Matrícula: 202123459

## Como Rodar o Sistema em PHP Utilizando XAMPP

Para rodar o sistema de Gestão de Frota de Veículos em PHP utilizando o XAMPP, siga os passos abaixo:

### 1. Instalação do XAMPP
1. Faça o download do XAMPP a partir do site oficial [Apache Friends](https://www.apachefriends.org/index.html).
2. Execute o instalador e siga as instruções para concluir a instalação.

### 2. Configuração do Ambiente
1. Após a instalação, abra o XAMPP Control Panel.
2. Inicie os serviços do Apache e MySQL clicando nos botões "Start" correspondentes.

### 3. Configuração do Banco de Dados
1. Abra o phpMyAdmin acessando `http://localhost/phpmyadmin` no seu navegador.
2. Crie um novo banco de dados para o sistema:
   - Clique em "New" no menu à esquerda.
   - Dê um nome ao banco de dados e clique em "Create".
3. Importe o arquivo SQL com as tabelas e dados necessários:
   - Com o banco de dados recém-criado selecionado, clique na aba "Import".
   - Selecione o arquivo SQL fornecido e clique em "Go" para importar.

### 4. Configuração do Projeto
1. Coloque os arquivos do projeto na pasta `htdocs` do XAMPP:
   - Por padrão, essa pasta está localizada em `C:\xampp\htdocs`.
2. Configure o arquivo de conexão com o banco de dados:
   - Abra o arquivo de configuração (por exemplo, `config.php`) no editor de sua preferência.
   - Atualize as informações de conexão com o banco de dados, como hostname, username, password e o nome do banco de dados.

### 5. Executar o Sistema
1. Abra o navegador e acesse o sistema utilizando o endereço: http://localhost/trabIntegrador/gestaoDeFrota
2. Você deverá ver a tela de login ou a página inicial do sistema, indicando que ele está funcionando corretamente.

Agora você está pronto para utilizar o sistema de Gestão de Frota de Veículos. Em caso de dúvidas ou problemas, consulte a documentação ou entre em contato com um dos membros do grupo.
