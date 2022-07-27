<section id="education">
    <div class="content-area">
        <div class="container">
            <header>
                <h3>
                    Backup
                </h3>
            </header>
            <div class="card">
                {{-- <button class="btn btn-success text-white" wire:click="db_backup">Take a Backup</button>
                <div wire:loading wire:target="db_backup">
                    Processing DB Backup...
                </div> --}}
                <button class="btn btn-danger text-white" wire:click="local_db_update_by_latest_backup">DB Update</button>
                <div wire:loading wire:target="local_db_update_by_latest_backup">
                    Local DB Updating by latedt backup...
                </div>
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
