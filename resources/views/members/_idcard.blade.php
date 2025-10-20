<style>
.idcard {
  width: 360px;
  border-radius: 28px;
  overflow: hidden;
  background: white;
  color: #1D503A;
  box-shadow: 0 6px 18px rgba(0,0,0,0.1);
  border: 1px solid #E5E7EB;
  font-family: 'Poppins', system-ui, sans-serif;
}

/* --- En-tête --- */
.idcard-header {
  background-color: #CFEEDC;
  position: relative;
  height: 160px;
  display: grid;
  place-items: center;
}
.idcard-header .logo {
  width: 90px;
  height: 90px;
  border-radius: 50%;
  background: white;
  display: grid;
  place-items: center;
  overflow: hidden;
  border: 1px solid #A7D7B3;
  box-shadow: 0 1px 4px rgba(0,0,0,0.05);
}
.idcard-notch {
  position: absolute;
  left: 50%;
  bottom: -12px;
  transform: translateX(-50%);
  width: 0;
  height: 0;
  border-left: 12px solid transparent;
  border-right: 12px solid transparent;
  border-top: 12px solid #CFEEDC;
}

/* --- Corps central --- */
.idcard-body {
  background: white;
  padding: 2rem 1.5rem 1.5rem;
  text-align: center;
}
.idcard-body .photo {
  width: 140px;
  height: 140px;
  border-radius: 24px;
  overflow: hidden;
  border: 1px solid #A7D7B3;
  box-shadow: 0 1px 6px rgba(0,0,0,0.05);
  margin: 0 auto 1rem;
  background: white;
}
.idcard-body h2 {
  font-size: 2rem;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #3A3A3A;
}

/* --- Pied de carte --- */
.idcard-footer {
  background-color: #1D503A;
  color: white;
  padding: 1.75rem 1.5rem;
  position: relative;
  font-size: 0.9rem;
}
.idcard-footer::before {
  content: '';
  position: absolute;
  left: 50%;
  top: -14px;
  transform: translateX(-50%);
  width: 0;
  height: 0;
  border-left: 14px solid transparent;
  border-right: 14px solid transparent;
  border-bottom: 14px solid #1D503A;
}
.idcard-footer div {
  margin-bottom: 0.35rem;
}
.idcard-footer span {
  opacity: 0.8;
  font-weight: 500;
}
.idcard-footer strong {
  font-weight: 700;
}
</style>

<div class="idcard">
  <!-- En-tête -->
  <div class="idcard-header">
      <div class="logo">
          <!-- Logo utilisé dans le pop-up (aperçu à l'écran)
               Placez votre image dans public/storage/ avec le nom "logo-card.png".
               Pour changer plus tard, remplacez simplement ce fichier ou ajustez le chemin ci-dessous. -->
          <img src="{{ asset('storage/logo-card.png') }}" alt="Logo" class="w-full h-full object-contain p-2">
      </div>
      <div class="idcard-notch"></div>
  </div>

  <!-- Photo + Nom -->
  <div class="idcard-body">
      <div class="photo">
          @php
              $dbPath = $member->photo_path;
          @endphp
          @if (!empty($dbPath))
              <img src="{{ asset('storage/'.ltrim($dbPath,'/')) }}" alt="photo" class="w-full h-full object-cover">
          @else
              <div class="w-full h-full grid place-items-center text-gray-400 text-sm">Photo</div>
          @endif
      </div>
      @php
          $headline = !empty($member->position_title) ? strtoupper($member->position_title) : strtoupper($member->last_name);
      @endphp
      <h2>{{ $headline }}</h2>
  </div>

  <!-- Pied -->
  <div class="idcard-footer">
      <div><span>Nom :</span> <strong>{{ strtoupper($member->last_name) }}</strong></div>
      <div><span>Prénoms :</span> <strong>{{ strtoupper($member->first_names) }}</strong></div>
      <div><span>Numéro d’adhérent :</span> <strong>{{ $member->member_number }}</strong></div>
      <div><span>Année d’adhésion :</span> <strong>{{ $member->join_year }}</strong></div>
  </div>
</div>
