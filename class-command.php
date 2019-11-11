<?php 

// Only run through WP CLI.
if ( ! defined( 'WP_CLI' ) ) {
	return;
}
class wp_git_lists_commands extends WP_CLI_Command {
	public function __invoke( $args, $assoc_args ) {
		if(!file_exists('.git'))
		{
			WP_CLI::error( "Git not Initialized!" );
		}
		else
		{
			WP_CLI::run_command(array(' ls -l'));
			WP_CLI::log('----------------------------------------------------------------');
			WP_CLI::log('----------------------------------------------------------------');
			WP_CLI::log('--- Commands ------------ Description --------------------------');
			WP_CLI::log('----------------------------------------------------------------');
			WP_CLI::log('-- 1. git init 		-- Initialization of git. ---------------');
			WP_CLI::log('-- 2. git rm   		-- Remove git. --------------------------');
			WP_CLI::log('-- 3. git remote add   -- Add Origin ---------------------------');
			WP_CLI::log('-- 4. git push   		-- Pushing to Origin With Commit --------');
			WP_CLI::log('----------------------------------------------------------------');
			WP_CLI::log('----------------------------------------------------------------');
			
		}
	}//end of function
}//end of class
WP_CLI::add_command( 'git lists', 'wp_git_lists_commands' );
WP_CLI::add_command( 'git helps', 'wp_git_lists_commands' );

class wp_git_init_commands extends WP_CLI_Command {
	public function __invoke( $args, $assoc_args ) {

		if(file_exists('.git'))
		{
			WP_CLI::error( "Already Existing Git" );
		}
		else
		{
			shell_exec('git init');
			WP_CLI::success( "Initialized empty Git repository" );			
		}
	}//end of function
}//end of class
WP_CLI::add_command( 'git init', 'wp_git_init_commands' );

class wp_git_remove_commands extends WP_CLI_Command {
	public function __invoke( $args, $assoc_args ) {

		if(!file_exists('.git'))
		{
			WP_CLI::error( "Git not Initialized!" );
		}
		else
		{
			shell_exec('sudo rm -rf .git');
			WP_CLI::success( "Successfully remove Git repository" );			
		}
	}//end of function
}//end of class
WP_CLI::add_command( 'git rm', 'wp_git_remove_commands' );

class wp_git_status_commands extends WP_CLI_Command {
	public function __invoke( $args, $assoc_args ) {

		if(!file_exists('.git'))
		{
			WP_CLI::error( "Git not Initialized!" );
		}
		else
		{
			// WP_CLI::log(WP_CLI::colorize( "%GFile Changed/Added %n"));
			$modified=WP_CLI::colorize( "%RM%n ").shell_exec('git ls-files -m');
			$added=WP_CLI::colorize( "%GA%n ").shell_exec('git ls-files -o');
			WP_CLI::log($added.$modified);
		}
	}//end of function
}//end of class
WP_CLI::add_command( 'git status', 'wp_git_status_commands' );


class wp_git_add_remote_commands extends WP_CLI_Command 
{
	public function __invoke( $args, $assoc_args ) 
	{

		if(!file_exists('.git'))
		{
			WP_CLI::error( "Not a git repository (or any of the parent directories):" );
		}
		else
		{
			if(count($args)>0)
			{
				shell_exec('git remote add origin '.$args[0]);
				WP_CLI::success( "Repository added Successfully" );
			}
			else
			{
				WP_CLI::error( "Invalid Repository Path" );				
			}
		}
	}//end of function
}//end of class

WP_CLI::add_command( 'git remote add', 'wp_git_add_remote_commands' );


class wp_git_push_commands extends WP_CLI_Command {
	public function __invoke( $args, $assoc_args ) {

		if(!file_exists('.git'))
		{
			WP_CLI::error( "Git not Initialized!" );
		}
		else
		{
			if(count($args)>0)
			{
				shell_exec('git add .');
				shell_exec('git commit -m "'.$args[0].'"');
				shell_exec('git push origin master');
				WP_CLI::success( "Successfully Pushed Git repository" );

			}
			else{
				WP_CLI::error( "Invalid Command request" );			
			}			
		}
	}//end of function
}//end of class
WP_CLI::add_command( 'git push', 'wp_git_push_commands' );