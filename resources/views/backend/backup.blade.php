<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    Backups
                </h3>
            </header>
            <div class="card">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">File</th>
                            <th scope="col">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($backups as $backup)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{!! $backup !!}</td>
                            <td>
                                <a href="{{ asset("storage/backups/$backup") }}">Download</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>
</section>
