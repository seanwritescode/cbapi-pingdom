package {"php5-curl": ensure => "installed" }
package {"php5": ensure => "installed" }
package {"php5-json": ensure => "installed" }
class { "apache": }
