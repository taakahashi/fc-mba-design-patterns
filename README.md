# MBA Fullcycle - Design Patterns
Projeto prático para exemplificar alguns patterns em uma aplicação para emissão de notas fiscais. Neste projeto, os patterns serão inseridos aos poucos para exemplificar onde cada um pode ajudar/melhorar.


## Patterns 
1. **DTO (Data Transfer Object):** objeto que têm somente propriedades, sendo utilizado para transporte entre camadas da aplicação. Neste exemplo estamos utilizando a nomenclatura Input/Output;
2. **Repository**: é um padrão que tem como objetivo realizar a persistência de Aggregates (clusters de objetos de domínio, como entities e value objects), separando essa responsabilidade da aplicação;
3. **Adapter**: converte a interface de uma classe em outra esperada pelo cliente, permitindo que classes incompatíveis trabalhem juntas;

## SOLID
1. **SRP - Single Responsability Principle**: devemos separar coisas que mudam por motivos diferentes;
2. **DIP - Dependency Inversion Principle**: componentes de alto nível não devem depender de componentes de baixo nível, eles devem depender de abstrações;

## Informações Adicionais
Será utilizado SQLite3 no BD para agilizar, visto que são somente exemplos e estudos.

## Comandos utilizados
    PHP
    $ php script_database.php //script utilizado para construir a estrutura do BD

    SQLITE3
    $ sqlite3 database.sqlite; //comando para acessar o SQLite e realizar operações de DML
    $ .tables; //lista as tabelas do BD
    $ .schema table_name //exibe o create da tabela, sem o ';' no final