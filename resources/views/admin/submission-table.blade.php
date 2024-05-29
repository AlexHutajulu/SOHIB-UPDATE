<div class="table-responsive">
    <table id="datatablesSimple" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>No Telepon</th>
                <th>Jenis Bank</th>
                <th>No Rekening</th>
                <th>Email</th>
                <th>Ibadah</th>
                <th>Lihat File</th>
                <th>Upload SK</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($submissions as $submission)
                <tr>
                    <td>{{ $submission->nik }}</td>
                    <td>{{ $submission->name }}</td>
                    <td>{{ $submission->phone }}</td>
                    <td>{{ $submission->bank_name }}</td>
                    <td>{{ $submission->bank_account}}</td>
                    <td>{{ $submission->email }}</td>
                    <td>{{ $submission->ibadah }}</td>
                    <td style="text-align: center; vertical-align: middle;">
                        <a href="{{ route('admin.file', $submission->id) }}" style="display: block; text-align: center;">
                            <i class="fa-regular fa-eye fa-lg" style="color: #005eff;"></i>
                        </a>
                    </td>                    
                    <td style="text-align: center; vertical-align: middle;">
                        <form action="{{ route('admin.uploadSk', $submission->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="sk_file" accept=".pdf, .doc, .docx" id="fileInput{{ $submission->id }}" style="display: none;" onchange="submitForm(this)">
                            <button type="button" class="btn btn-success btn-sm" onclick="openFileInput({{ $submission->id }})">Upload</button>
                        </form>
                    </td>
                    <td>{{ $submission->status ?? 'NULL' }}</td>
                    <td class="table-actions">
                        <form action="{{ route('admin.destroy', $submission->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                        </form>
                    </td>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function openFileInput(submissionId) {
        document.getElementById(`fileInput${submissionId}`).click();
    }

    function submitForm(input) {
        input.form.submit();
    }
</script>
