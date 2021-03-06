<?php

namespace Grocy\Services;

class BatteriesService extends BaseService
{
	public function GetCurrent()
	{
		$sql = 'SELECT * from batteries_current';
		return $this->DatabaseService->ExecuteDbQuery($sql)->fetchAll(\PDO::FETCH_OBJ);
	}

	public function GetNextChargeTime(int $batteryId)
	{
		if (!$this->BatteryExists($batteryId))
		{
			throw new \Exception('Battery does not exist');
		}
		
		$battery = $this->Database->batteries($batteryId);
		$batteryLastLogRow = $this->DatabaseService->ExecuteDbQuery("SELECT * from batteries_current WHERE battery_id = $batteryId LIMIT 1")->fetch(\PDO::FETCH_OBJ);

		if ($battery->charge_interval_days > 0)
		{
			return date('Y-m-d H:i:s', strtotime('+' . $battery->charge_interval_days . ' day', strtotime($batteryLastLogRow->last_tracked_time)));
		}
		else
		{
			return date('2999-12-31 23:59:59');
		}

		return null;
	}

	public function GetBatteryDetails(int $batteryId)
	{
		if (!$this->BatteryExists($batteryId))
		{
			throw new \Exception('Battery does not exist');
		}

		$battery = $this->Database->batteries($batteryId);
		$batteryChargeCylcesCount = $this->Database->battery_charge_cycles()->where('battery_id', $batteryId)->count();
		$batteryLastChargedTime = $this->Database->battery_charge_cycles()->where('battery_id', $batteryId)->max('tracked_time');

		return array(
			'battery' => $battery,
			'last_charged' => $batteryLastChargedTime,
			'charge_cycles_count' => $batteryChargeCylcesCount
		);
	}

	public function TrackChargeCycle(int $batteryId, string $trackedTime)
	{
		if (!$this->BatteryExists($batteryId))
		{
			throw new \Exception('Battery does not exist');
		}

		$logRow = $this->Database->battery_charge_cycles()->createRow(array(
			'battery_id' => $batteryId,
			'tracked_time' => $trackedTime
		));
		$logRow->save();

		return true;
	}

	private function BatteryExists($batteryId)
	{
		$batteryRow = $this->Database->batteries()->where('id = :1', $batteryId)->fetch();
		return $batteryRow !== null;
	}
}
