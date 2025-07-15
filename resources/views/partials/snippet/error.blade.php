@if ($errors->any())
                    <div class="alert alert-danger mt-2">
                        <strong>Whoops!</strong> Please fix the following errors:
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif