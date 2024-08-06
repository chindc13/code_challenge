<h3>READ ME</h3>
<table>
    <thead>
        <th>Name</th>
        <th>Method</th>
        <th>Path</th>
    <thead>
    <tbody>
        <tr>
            <td>get_customers</td>
            <td>GET</td>
            <td>/customers</td>
        </tr>
        <tr>
            <td>get_customer</td>
            <td>GET</td>
            <td>/customers/{id}</td>
        </tr>
    </tbody>
</table>


<table>
    <thead>
        <th>Commands</th>
    <thead>
    <tbody>
        <tr>
            <td>composer update</td>
        </tr>
        <tr>
            <td>php bin/console cache:clear </td>
        </tr>
        <tr>
            <td><b>Importer Command: </b>php bin/console app:import-customers </td>
        </tr>
        <tr>
            <td>php bin/console debug:router </td>
        </tr>
        <tr>
            <td>php bin/console doctrine:mapping:info </td>
        </tr>
        <tr>
            <td>php bin/console doctrine:migrations:status </td>
        </tr>
        <tr>
            <td>php bin/console doctrine:migrations:migrate </td>
        </tr>
        <tr>
            <td>php bin/console doctrine:schema:validate </td>
        </tr>
        <tr>
            <td>php bin/console server:start</td>
        </tr>
        <tr>
            <td><b>Alternative:</b>php -S 127.0.0.1:8000 -t public</td>
        </tr>
        <tr>
            <td>php bin/phpunit</td>
        </tr>
    </tbody>
</table>