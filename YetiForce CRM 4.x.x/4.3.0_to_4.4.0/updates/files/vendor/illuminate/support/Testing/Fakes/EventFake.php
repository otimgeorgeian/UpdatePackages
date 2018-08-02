<?php

namespace Illuminate\Support\Testing\Fakes;

use Closure;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Arr;
use PHPUnit\Framework\Assert as PHPUnit;

class EventFake implements Dispatcher
{
	/**
	 * The original event dispatcher.
	 *
	 * @var \Illuminate\Contracts\Events\Dispatcher
	 */
	protected $dispatcher;

	/**
	 * The event types that should be intercepted instead of dispatched.
	 *
	 * @var array
	 */
	protected $eventsToFake;

	/**
	 * All of the events that have been intercepted keyed by type.
	 *
	 * @var array
	 */
	protected $events = [];

	/**
	 * Create a new event fake instance.
	 *
	 * @param \Illuminate\Contracts\Events\Dispatcher $dispatcher
	 * @param array|string                            $eventsToFake
	 */
	public function __construct(Dispatcher $dispatcher, $eventsToFake = [])
	{
		$this->dispatcher = $dispatcher;

		$this->eventsToFake = Arr::wrap($eventsToFake);
	}

	/**
	 * Assert if an event was dispatched based on a truth-test callback.
	 *
	 * @param string            $event
	 * @param callable|int|null $callback
	 */
	public function assertDispatched($event, $callback = null)
	{
		if (is_int($callback)) {
			return $this->assertDispatchedTimes($event, $callback);
		}

		PHPUnit::assertTrue(
			$this->dispatched($event, $callback)->count() > 0,
			"The expected [{$event}] event was not dispatched."
		);
	}

	/**
	 * Assert if a event was dispatched a number of times.
	 *
	 * @param string $event
	 * @param int    $times
	 */
	public function assertDispatchedTimes($event, $times = 1)
	{
		PHPUnit::assertTrue(
			($count = $this->dispatched($event)->count()) === $times,
			"The expected [{$event}] event was dispatched {$count} times instead of {$times} times."
		);
	}

	/**
	 * Determine if an event was dispatched based on a truth-test callback.
	 *
	 * @param string        $event
	 * @param callable|null $callback
	 */
	public function assertNotDispatched($event, $callback = null)
	{
		PHPUnit::assertTrue(
			$this->dispatched($event, $callback)->count() === 0,
			"The unexpected [{$event}] event was dispatched."
		);
	}

	/**
	 * Get all of the events matching a truth-test callback.
	 *
	 * @param string        $event
	 * @param callable|null $callback
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function dispatched($event, $callback = null)
	{
		if (!$this->hasDispatched($event)) {
			return collect();
		}

		$callback = $callback ?: function () {
			return true;
		};

		return collect($this->events[$event])->filter(function ($arguments) use ($callback) {
			return $callback(...$arguments);
		});
	}

	/**
	 * Determine if the given event has been dispatched.
	 *
	 * @param string $event
	 *
	 * @return bool
	 */
	public function hasDispatched($event)
	{
		return isset($this->events[$event]) && !empty($this->events[$event]);
	}

	/**
	 * Register an event listener with the dispatcher.
	 *
	 * @param string|array $events
	 * @param mixed        $listener
	 */
	public function listen($events, $listener)
	{
	}

	/**
	 * Determine if a given event has listeners.
	 *
	 * @param string $eventName
	 *
	 * @return bool
	 */
	public function hasListeners($eventName)
	{
	}

	/**
	 * Register an event and payload to be dispatched later.
	 *
	 * @param string $event
	 * @param array  $payload
	 */
	public function push($event, $payload = [])
	{
	}

	/**
	 * Register an event subscriber with the dispatcher.
	 *
	 * @param object|string $subscriber
	 */
	public function subscribe($subscriber)
	{
	}

	/**
	 * Flush a set of pushed events.
	 *
	 * @param string $event
	 */
	public function flush($event)
	{
	}

	/**
	 * Fire an event and call the listeners.
	 *
	 * @param string|object $event
	 * @param mixed         $payload
	 * @param bool          $halt
	 *
	 * @return array|null
	 */
	public function fire($event, $payload = [], $halt = false)
	{
		return $this->dispatch($event, $payload, $halt);
	}

	/**
	 * Fire an event and call the listeners.
	 *
	 * @param string|object $event
	 * @param mixed         $payload
	 * @param bool          $halt
	 *
	 * @return array|null
	 */
	public function dispatch($event, $payload = [], $halt = false)
	{
		$name = is_object($event) ? get_class($event) : (string) $event;

		if ($this->shouldFakeEvent($name, $payload)) {
			$this->events[$name][] = func_get_args();
		} else {
			$this->dispatcher->dispatch($event, $payload, $halt);
		}
	}

	/**
	 * Determine if an event should be faked or actually dispatched.
	 *
	 * @param string $eventName
	 * @param mixed  $payload
	 *
	 * @return bool
	 */
	protected function shouldFakeEvent($eventName, $payload)
	{
		if (empty($this->eventsToFake)) {
			return true;
		}

		return collect($this->eventsToFake)
			->filter(function ($event) use ($eventName, $payload) {
				return $event instanceof Closure
							? $event($eventName, $payload)
							: $event === $eventName;
			})
			->isEmpty();
	}

	/**
	 * Remove a set of listeners from the dispatcher.
	 *
	 * @param string $event
	 */
	public function forget($event)
	{
	}

	/**
	 * Forget all of the queued listeners.
	 */
	public function forgetPushed()
	{
	}

	/**
	 * Dispatch an event and call the listeners.
	 *
	 * @param string|object $event
	 * @param mixed         $payload
	 */
	public function until($event, $payload = [])
	{
		return $this->dispatch($event, $payload, true);
	}
}