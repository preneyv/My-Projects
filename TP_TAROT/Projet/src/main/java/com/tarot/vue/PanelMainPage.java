package com.tarot.vue;


import com.tarot.model.Card;
import com.tarot.model.Player;
import com.tarot.observer.Observer;

import javax.swing.*;
import javax.swing.border.EmptyBorder;
import java.awt.*;

/**
 * This panel contains all the components after the user has validate the welcome form
 */
public class PanelMainPage extends JPanel implements IGotBtnClickable, Observer {

    private PanelSideBar sideBar;
    //top of the sidebar

    private final JPanel rightMain = new JPanel();
        private PanelCollectionCard collectionCard;
        private final JPanel detailAndAddCard = new JPanel();
            //
            private PanelDetailCard panelDetail;
            private final PanelFormAddCard panelFormAddCard = new PanelFormAddCard();


    private final GridBagLayout bL = new GridBagLayout();
    private final GridBagConstraints gbC = new GridBagConstraints();

    /**
     * Constructor
     */
    public PanelMainPage()
    {

        this.setLayout(bL);
        initComponent();
        this.setVisible(true);
    }

    /**
     * Init the components
     */
    private void initComponent()
    {
        /*Init required properties of this panel*/
        this.setPreferredSize(new Dimension(Toolkit.getDefaultToolkit().getScreenSize().width - 500, Toolkit.getDefaultToolkit().getScreenSize().height - 100));
        this.setMaximumSize(new Dimension(Toolkit.getDefaultToolkit().getScreenSize().width - 500, Toolkit.getDefaultToolkit().getScreenSize().height - 100));
        this.setSize(new Dimension(500, 500));


        this.sideBar = new PanelSideBar();
        this.collectionCard =  new PanelCollectionCard(this);
        this.panelDetail =  new PanelDetailCard();

        this.collectionCard.setMaximumSize(new Dimension(8*95,-1 ));
        this.collectionCard.setPreferredSize(new Dimension(8*95,-1 ));

        /*Set Constraints of the sideBAr*/

        this.gbC.gridx = 1;
        this.gbC.gridy= 0;
        this.gbC.weightx = 0.05;
        this.gbC.weighty = 1;
        this.gbC.fill = GridBagConstraints.BOTH;
        this.add(this.sideBar,gbC);

        /*Set Constraints of the collectionCard Panel*/
        this.rightMain.setLayout(bL);
        this.gbC.gridx = 1;
        this.gbC.gridy= 0;
        this.gbC.weightx = 0.6;
        this.gbC.weighty = 1;
        this.gbC.fill = GridBagConstraints.BOTH;
        this.rightMain.add(this.collectionCard,this.gbC);

        /*Add Elements to panel detail an add card*/

        this.detailAndAddCard.setLayout(bL);
        this.gbC.gridx = 0;
        this.gbC.gridy= 0;
        this.gbC.weightx = 1;
        this.gbC.weighty = 0.1;
        this.gbC.fill = GridBagConstraints.BOTH;
        this.detailAndAddCard.add(this.panelDetail,this.gbC);

        this.gbC.gridx = 0;
        this.gbC.gridy= 1;
        this.gbC.weightx = 1;
        this.gbC.weighty = 0.9;
        this.gbC.fill = GridBagConstraints.BOTH;
        this.detailAndAddCard.add(this.panelFormAddCard,this.gbC);

        /*Set Constraints of the detail and add card Panel*/
        this.gbC.gridx = 2;
        this.gbC.gridy= 0;
        this.gbC.weightx = 0.4;
        this.gbC.weighty = 1;
        this.rightMain.setBorder(new EmptyBorder(5,5,5,5));
        this.rightMain.add(this.detailAndAddCard,this.gbC);

        this.rightMain.setBackground(new Color(54,54,58));
        this.gbC.gridx = 2;
        this.gbC.gridy= 0;
        this.gbC.weightx = 0.95;
        this.add(this.rightMain,gbC);


    }

    /**
     * This method comes from the observer interface - will update when a change has been observed
     * @param p Player has been set
     */
    @Override
    public void update(Player p) {
        this.sideBar.update(p);
        this.collectionCard.update(p);
    }

    /**
     * This method comes from the IGotBtnClickable interface - btnDel(CardJButton) linked to this panel
     * so the panelDetail can reset in case the deleted card is displayed in panelDetail. Unpossible from
     * panelCollectionCard
     * @param c Component triggered the event
     */
    @Override
    public void pressBtn(Component c) {
        if(c.getName().equals("btnDel"))
        {
            Card cardToDel = ((CardIsJButton)c.getParent().getComponent(1)).getCard();
            if(cardToDel == this.panelDetail.getCardInUse() && this.panelDetail.getCardInUse()!=null)
                this.panelDetail.clearPanel();

            VueTest.listController.get(0).removeCollectionCardPlayer(cardToDel);
        }
        if(c.getName().equals("cardToAdd"))
        {
            CardIsJButton cardClicked = (CardIsJButton)c;
            this.panelDetail.setPanelDetail(cardClicked.getCard());
        }

    }
}
