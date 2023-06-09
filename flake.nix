{
  inputs = {
    flake-utils.url = "github:numtide/flake-utils";
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-unstable";
  };

  outputs = { flake-utils, nixpkgs, ... }:
    flake-utils.lib.eachDefaultSystem (system:
      let
        pkgs = import nixpkgs {
          inherit system;
          config.allowUnfree = true;
        };

        # pkgs = nixpkgs.legacyPackages.${system};
      in
      {
        devShell = pkgs.mkShell {
          buildInputs = with pkgs; [
            nil # Nix language server
            nixpkgs-fmt # Nix formatter
            # nodePackages.intelephense
            php82
            php82Packages.composer
            php82Packages.php-cs-fixer
            php82Packages.phpstan
            php82Packages.psalm
            phpactor
          ];
        };
      }
    );
}
