<?php
/**
 * Tests for core plugin functionality.
 *
 * @package SecuritytxtManager
 */

namespace SecuritytxtManager\Core {
	/**
	 * Record registered actions for assertions.
	 *
	 * @param string   $hook_name Hook name.
	 * @param callable $callback  Hook callback.
	 *
	 * @return void
	 */
	function add_action( $hook_name, $callback ) {
		$GLOBALS['security_txt_manager_test_actions'][] = [ $hook_name, $callback ];
	}

	/**
	 * Record registered filters for assertions.
	 *
	 * @param string   $hook_name Hook name.
	 * @param callable $callback  Hook callback.
	 *
	 * @return void
	 */
	function add_filter( $hook_name, $callback ) {
		$GLOBALS['security_txt_manager_test_filters'][] = [ $hook_name, $callback ];
	}

	/**
	 * Record removed actions for assertions.
	 *
	 * @param string   $hook_name Hook name.
	 * @param callable $callback  Hook callback.
	 *
	 * @return bool
	 */
	function remove_action( $hook_name, $callback ) {
		$GLOBALS['security_txt_manager_test_removed_actions'][] = [ $hook_name, $callback ];

		return true;
	}
}

namespace SecuritytxtManager\Tests {
	use PHPUnit\Framework\TestCase;
	use const SecuritytxtManager\Constants\QUERY_VAR;
	use function SecuritytxtManager\Core\disable_canonical_redirect;
	use function SecuritytxtManager\Core\setup;

	/**
	 * Test core plugin functionality.
	 */
	final class CoreTests extends TestCase {
		/**
		 * Reset hook records before each test.
		 *
		 * @return void
		 */
		protected function setUp(): void {
			$GLOBALS['security_txt_manager_test_actions']         = [];
			$GLOBALS['security_txt_manager_test_filters']         = [];
			$GLOBALS['security_txt_manager_test_removed_actions'] = [];
		}

		/**
		 * The canonical redirect guard is registered early enough to prevent redirects.
		 *
		 * @return void
		 */
		public function test_setup_registers_parse_request_handler() {
			setup();

			$this->assertContains(
				[ 'parse_request', 'SecuritytxtManager\\Core\\disable_canonical_redirect' ],
				$GLOBALS['security_txt_manager_test_actions']
			);
		}

		/**
		 * Canonical redirects are disabled for a matched security.txt rewrite.
		 *
		 * @return void
		 */
		public function test_disables_canonical_redirect_for_security_txt_request() {
			$wp = (object) [
				'query_vars' => [ QUERY_VAR => '1' ],
			];

			disable_canonical_redirect( $wp );

			$this->assertSame(
				[ [ 'template_redirect', 'redirect_canonical' ] ],
				$GLOBALS['security_txt_manager_test_removed_actions']
			);
		}

		/**
		 * Canonical redirects remain enabled for unrelated requests.
		 *
		 * @return void
		 */
		public function test_preserves_canonical_redirect_for_other_requests() {
			$wp = (object) [
				'query_vars' => [],
			];

			disable_canonical_redirect( $wp );

			$this->assertSame( [], $GLOBALS['security_txt_manager_test_removed_actions'] );
		}
	}
}
