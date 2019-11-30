 @csrf
                    <input type="text" value="{{ old("name") ?? $id->name }}" name="a_name" placeholder="Enter name" class="form-control" />
                    <br/>
                    <input type="text" name="a_phone" placeholder="Enter mail" class="form-control" />
                    <br/>
                    <input type="submit" class="btn btn-sm btn-danger" />