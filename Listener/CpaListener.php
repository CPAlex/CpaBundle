<?php

namespace Simu\CpaBundle\Listener;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Claroline\CoreBundle\Event\DisplayToolEvent;
use Symfony\Bundle\TwigBundle\TwigEngine; 
/**
 *  @DI\Service()
 */
class CpaListener
{
    private $container;
	private $templating; 
    /**
     * @DI\InjectParams({
     *     "container" = @DI\Inject("service_container"),
     *     "templating" = @DI\Inject("templating")
     * })
     */
    public function __construct(ContainerInterface $container, TwigEngine $templating )
    {
        $this->container = $container;
		$this->templating = $templating; 
    }

    /**
     * @DI\Observe("open_tool_workspace_cpa")
     *
     * @param DisplayToolEvent $event
     */
    public function onDisplayWorkspace(DisplayToolEvent $event)
    {
        $event->setContent('Change me for workspace !');
    }

    /**
     * @DI\Observe("open_tool_desktop_Cpa")
     *
     * @param DisplayToolEvent $event
     */
    public function onDisplayDesktop(DisplayToolEvent $event)
    {
        $content = $this->templating->render(
            'SimuCpaBundle::desktopCpaList.html.twig',
            array(
            )
        );
//		$content = 'Alex';
        $event->setContent($content);
		$event->stopPropagation();
    }
}
