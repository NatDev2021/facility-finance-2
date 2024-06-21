<div class="row g-3">
    <div class="col-md-2">
        <div class="form-group">
            <label for="inputName">CPF</label>
            <x-input-cpf name="document" id="document" value="{{ $user->document ?? '' }}" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="inputName">Nome</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $user->name ?? '' }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="inputName">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email ?? '' }}">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Perfil</label>
            <select class="form-control" name="profile">
                <option @selected(($user->profile ?? '') == 'admin') value="admin">Administrador</option>
                <option @selected(($user->profile ?? '') == 'user') value="user">Usuário</option>
            </select>
        </div>
    </div>




</div>
