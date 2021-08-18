@component('mail::message')
    <div class="row">
      <h2>Order Invoice</h2>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>a</th>
                        <th>b</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>test</td>
                        <td>test2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
